<?php

/**
 * User: lhaos
 * Date: 29/04/2016
 */
class Mapper{

    public function __construct() {

    }

    function __get($var) {
        if (property_exists($this, $var)) {
            return $this->$var;
        } else {
            return null;
        }
    }

    function __set($var, $val) {
        if (property_exists($this, $var)) {
            $this->$var = $val;
        }
    }

    public function getPDOConstantType($var) {
        if (is_int($var))
            return \PDO::PARAM_INT;
        if (is_bool($var))
            return \PDO::PARAM_BOOL;
        if (is_null($var))
            return \PDO::PARAM_NULL;

        //Default
        return \PDO::PARAM_STR;
    }

    /**
     * Função que pega o nome dos campos de uma tabela
     * @param array
     */
    public function Prepare($arr) {
        foreach ($arr as $campo => $value) {
            if (!is_array($value)) {
                $this->$campo = $value;
            }
        }
    }

    /**
     * Função que pega o nome dos campos de uma tabela e compara com o array passado
     * @param array
     */
    public function Comparator($arr) {
        $comp = false;
        foreach ($arr as $campo => $value) {
            if (!is_array($value)) {
                if (property_exists($this, $campo)) {
                    if ($this->$campo != $value) {
                        $comp = true;
                        break;
                    }
                }
            }
        }
        return $comp;
    }

    /**
     * Função que inicializa as variaveis com os valores default do banco
     */
    public function LoadDefault() {
        $dbClass = $this->objDb;
        $dbClass->clearAll();

        $dbClass->Query($dbClass->Fields($this->tabela));

        while ($dado = $dbClass->Fetch()) {
            $campo = $dado->Field;
            if (preg_match("(int)", $dado->Type)) {
                $valor = $dado->Default != "" || $dado->Default != null ? $dado->Default : 0;
                $this->$campo = $valor;
            } else if (preg_match("(date)", $dado->Type)) {
                $this->$campo = null;
            } else {
                $valor = $dado->Default != "" || $dado->Default != null ? $dado->Default : '';
                $this->$campo = $valor;
            }
        }
    }

    public function getVars() {
        $array = get_object_vars($this);
        $return = array();
        foreach ($array as $key => $value) {
            $return[$key] = $value;
        }

        return $return;
    }

    public function find($codigo) {

        $dbClass = $this->objDb;
        $dbClass->clearAll();
        $dbClass->setFrom($this->tabela);
        $dbClass->setWhere(" && {$this->chave} = {$codigo}");
        $dbClass->Query($dbClass->Select());

        return $dbClass->Fetch();
    }

    /**
     * Função que carrega os dados do banco para o objeto
     * @param int $codigo
     */
    public function Load($codigo) {
        $codigo = (int) $codigo;
        $dbClass = $this->objDb;
        $dbClass->clearAll();
        $dbClass->setFrom($this->tabela);
        $dbClass->setWhere(" && {$this->chave} = {$codigo}");
        $dbClass->Query($dbClass->Select());

        $dado = $dbClass->Fetch();

        if ($dbClass->NumRows() > 0) {
            $dbClass->Query($dbClass->Fields($this->tabela));
            while ($field = $dbClass->Fetch()) {
                $campo = $field->Field;
                $value = $dado->$campo;
                $this->$campo = stripslashes($value);
            }
        } else {
            return false;
        }
    }

    /**
     * Função que cadastra os dados no banco
     */
    public function Insert($ignore = false) {
        $dbClass = $this->objDb;
        $dbClass->clearAll();
        $dbClass->Query($dbClass->Fields($this->tabela));

        $sql = "INSERT ";
        if ($ignore) {
            $sql .= " IGNORE ";
        }

        $sql .= " INTO {$this->tabela} (";

        while ($dado = $dbClass->Fetch()) {
            $bfCampo[] = $dado->Field;
            $getCampo[] = array("Campo" => $dado->Field, "Default" => $dado->Default, "Null" => $dado->Null);
        }

        $sql .= implode(",", $bfCampo);
        $sql .= ") VALUES (:" . implode(", :", $bfCampo) . ");";

        $stmt = $dbClass->Conn()->prepare($sql);

        foreach ($getCampo as $campo) {
            $value = $this->$campo["Campo"] ? $this->$campo["Campo"] : ($campo["Null"] == "YES" ? NULL : (string) $campo["Default"]);
            $stmt->bindValue(':' . $campo["Campo"], $value, $this->getPDOConstantType($value));
        }

        if (!$stmt->execute()) {
            Util::_logx($stmt->errorInfo()[2]);
            Util::_logx($stmt->queryString);
            return false;
        } else {
            $campoChave = $this->chave;
            $this->$campoChave = $dbClass->Conn()->LastInsertId();
            return true;
        }
    }

    /**
     * Função que edita os dados
     */
    public function Update() {
        $sql = "UPDATE {$this->tabela} SET ";
        $dbClass = $this->objDb;
        $dbClass->clearAll();
        $dbClass->Query($dbClass->Fields($this->tabela));

        while ($dado = $dbClass->Fetch()) {
            $bfCampo[] = $dado->Field . " = :" . $dado->Field;
            $getCampo[] = array("Campo" => $dado->Field, "Default" => $dado->Default, "Null" => $dado->Null);
        }

        $sql .= implode(",", $bfCampo);
        $campoId = $this->chave;
        $sql .= " WHERE {$this->chave} = :{$this->chave}";

        $stmt = $dbClass->Conn()->prepare($sql);

        foreach ($getCampo as $campo) {
            $value = $this->$campo["Campo"] ? $this->$campo["Campo"] : ($campo["Null"] == "YES" ? NULL : (string) $campo["Default"]);
            $stmt->bindValue(':' . $campo["Campo"], $value, $this->getPDOConstantType($value));
        }

        if (!$stmt->execute()) {
            Util::_logx($stmt->errorInfo()[2]);
            Util::_logx($stmt->queryString);
            return false;
        } else {
            return true;
        }
    }

    /**
     * Função que exclui os dados do banco
     */
    public function Delete($codigo) {
        $codigo = (int) $codigo;

        $sql = "DELETE FROM {$this->tabela} WHERE {$this->chave} = {$codigo}";
        $dbClass = $this->objDb;
        $dbClass->clearAll();

        if (!$dbClass->Exec($sql)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Gera a referencia para a url amigavel
     * @param string $campo
     */
    public function geraRefAmigavel($campo = "titulo") {
        $id_campo = $this->chave;

        $this->ref_amigavel = Util::_geraUrlAmigavel($this->$campo);
        if (!$this->isValidRefAmigavel()) {
            $bfRefAmigavel = $this->ref_amigavel;
            $this->ref_amigavel .= "-" . $this->getContByRefAmigavel();
            if (!$this->isValidRefAmigavel()) {
                $this->ref_amigavel = $bfRefAmigavel . "-" . (int) $this->$id_campo;
            }
        }
        $this->Update();
    }

    /**
     * Checa se é uma referencia amigavel verdadeira
     * @return boolean
     */
    public function isValidRefAmigavel() {
        return $this->getContByRefAmigavel() > 0 ? false : true;
    }

    /**
     * Retorna a quantidade de existencias da referencia amigavel
     */
    public function getContByRefAmigavel() {
        $id_campo = $this->chave;
        $sql = "SELECT COUNT(*) AS CONT FROM {$this->tabela} WHERE ref_amigavel = '{$this->ref_amigavel}' && {$this->chave} != " . (int) $this->$id_campo;

        $dbClass = $this->objDb;
        $dbClass->clearAll();
        $dbClass->Query($sql);
        $dado = $dbClass->Fetch();

        return $dado->CONT;
    }

    /**
     * Checa se existe
     * @param string $campo
     * @param string $value
     * @return boolean
     */
    public function isExist($arr = array()) {
        $id_campo = $this->chave;

        $dbClass = $this->objDb;
        $dbClass->clearAll();
        $dbClass->setColumns("COUNT(*) AS CONT");
        $dbClass->setFrom($this->tabela);

        if (count($arr) > 0) {
            foreach ($arr as $campo => $value) {
                $dbClass->setWhere(" && " . $campo . " = '" . addslashes($value) . "'");
            }
        }

        $dbClass->setWhere(" && " . $this->chave . " != " . (int) $this->$id_campo);

        $dbClass->Query($dbClass->Select());
        $dado = $dbClass->Fetch();

        if ($dado->CONT > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checa se existe
     * @param string $campo
     * @param string $value
     * @return boolean
     */
    public function findSearch($arr = array()) {

        $dbClass = $this->objDb;
        $dbClass->clearAll();
        $dbClass->setColumns("*");
        $dbClass->setFrom($this->tabela);

        if (count($arr) > 0) {
            foreach ($arr as $campoComOperador => $value) {
                $dbClass->setWhere(" && {$campoComOperador} '" . addslashes($value) . "'");
            }
        }

        $dbClass->Query($dbClass->Select());
        return $dbClass->Fetch();
    }

    /**
     * Checa se existe
     * @param string $campo
     * @param string $value
     * @return boolean
     */
    public function getObjByRefAmigavel($ref_amigavel = '') {
        $dbClass = $this->objDb;
        $dbClass->clearAll();
        $dbClass->setColumns($this->chave . " AS ID");
        $dbClass->setFrom($this->tabela);
        $dbClass->setWhere(" && ref_amigavel = '" . addslashes($ref_amigavel) . "'");
        $dbClass->Query($dbClass->Select());
        $dado = $dbClass->Fetch();
        $this->Load($dado->ID);
    }

}//fecha classe