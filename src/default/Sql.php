<?php

/**
 * User: lhaos
 * Date: 29/04/2016
 */

class Sql{

    protected $conn;
    private $stmt;
    private $columns = "*";
    private $from;
    private $where;
    private $join;
    private $order;
    private $group;
    private $limit;

    /**
     * Inicializa as variaveis
     */
    public function __construct($con) {
        $this->clearAll();
        $this->conn = $con;
    }

    public function getColumns() {
        return $this->columns;
    }

    public function getFrom() {
        return $this->from;
    }

    public function getWhere() {
        return $this->where;
    }

    public function getJoin() {
        return $this->join;
    }

    public function getOrder() {
        return $this->order;
    }

    public function getGroup() {
        return $this->group;
    }

    public function getLimit() {
        return $this->limit;
    }

    ////Compatibilidade
    public function setColumns($columns) {
        $this->columns = $columns;
        return $this;
    }



    public function setFrom($from) {
        $this->from = $from;
        return $this;
    }

    public function setWhere($where) {
        $this->where .= " " . $where;
        return $this;
    }

    public function setJoin($join) {
        $this->join .= " " . $join;
        return $this;
    }

    public function setOrder($order) {
        $this->order = $order;
        return $this;
    }

    public function setGroup($group) {
        $this->group = $group;
        return $this;
    }

    public function setLimit($limit) {
        $this->limit = $limit;
        return $this;
    }

    //Metodos de limpeza

    public function clearWhere() {
        $this->where = "";
        return $this;
    }

    public function clearJoin() {
        $this->join = "";
        return $this;
    }

    public function clearAll() {
        $this->columns = "*";
        $this->from = "";
        $this->where = "";
        $this->join = "";
        $this->order = "";
        $this->group = "";
        $this->limit = "";
        return $this;
    }

    /**
     * Retorna esta conexão ao banco de dados
     *
     * @return resource
     */
    public function Conn() {
        return $this->conn;
    }

    /**
     * Fecha a conexão ao mysql
     *
     * @return bool
     */
    public function Close() {
        return $this->conn = NULL;
    }

    /**
     * Inicia uma transação de banco de dados
     *
     */
    public function StartTransaction() {
        if (!$this->conn->beginTransaction()) {
            throw new Exception('Erro ao iniciar a transação');
        }
    }

    /**
     * Executa o ROLLBACK na transação atual
     *
     */
    public function Rollback() {
        if (!$this->conn->rollback()) {
            throw new Exception('Erro ao executar o cancelamento da transação');
        }
    }

    /**
     * Executa o COMMIT da transação atual
     *
     */
    public function Commit() {
        if (!$this->conn->commit()) {
            throw new Exception('Erro ao salvar os dados da transação');
        }
    }

    /*     * ************* methods ********************* */

    /**
     * Executa um comando SQL no banco de dados
     * Executa direto sem preparar antes
     * @param string $sql
     * @return bool
     */
    public function Exec($sql) {
        if (!$this->conn->exec($sql)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Executa um comando SQL no banco de dados
     * Executa pos preparado no stmt
     * @param string $sql
     * @return resource
     */
    public function Query($sql) {
        if (!$this->stmt = $this->conn->prepare($sql)) {
            Util::_logx($this->conn->errorInfo()[2]);
            return false;
        } else {
            if (!$this->stmt->execute()) {
                Util::_logx($this->stmt->errorInfo()[2]);
                return false;
            }
            return $this->stmt;
        }
    }

    /**
     * Retorna uma linha de stmtado por chamada
     *
     * @return object
     */
    public function Fetch() {
        return $this->stmt->fetch(\PDO::FETCH_OBJ);
    }

    /**
     * Retorna uma linha de stmtado por chamada
     *
     * @return array
     */
    public function FetchArray() {
        return $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Retorna uma linha de stmtado por chamada
     *
     * @return array
     */
    public function FetchArrayAll() {
        return $this->stmt->fetchAll();
    }

    /**
     * Retorna uma linha de stmtado por chamada
     *
     * @return arrayObject
     */
    public function FetchAll() {
        return $this->stmt->fetchAll(\PDO::FETCH_CLASS);
    }
    /**
     * Retorna uma linha de stmtado por chamada
     *
     * @return arrayObject
     */
    public function FetchAllObj() {
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    /**
     * Retorna um array para multiplos stmtados
     * @param string $sql comando select
     * @return array
     */
    public function getArrayBySelect($sql) {
        if ($this->Query($sql)) {
            $i = 0;
            while ($linha = $this->FetchArray()) {
                $rsArray[$i] = $linha;
                $i++;
            }
            return $rsArray;
        } else {
            throw new Exception("Erro ao executar a query");
        }
    }

    /**
     * Retorna o número de linhas retornadas pela consulta SQL ou número de linhas modificadas por comandos como UPDATE e DELETE
     *
     * @return int
     */
    public function NumRows() {
        return $this->stmt->rowCount();
    }


    /**
     * Retorna o último autoincrement gerado
     *
     * @return int
     */
    public function LastInsertId() {
        return $this->conn->lastInsertId();
    }

    /**
     * Função que pega o nome dos campos de uma tabela
     * @param string
     * @return string
     */
    public function Fields($value) {
        return "SHOW COLUMNS FROM " . $value;
    }

    public function Select() {
        $sql = "SELECT " . $this->getColumns() . " FROM " . $this->getFrom() . " " . $this->getJoin();
        if ($this->getWhere() != "")
            $sql .= " WHERE 1 " . $this->getWhere();

        if ($this->getGroup() != "")
            $sql .= " GROUP BY " . $this->getGroup();

        if ($this->getOrder() != "")
            $sql .= " ORDER BY " . $this->getOrder();

        if ($this->getLimit() != "")
            $sql .= " LIMIT " . $this->getLimit();

        return $sql;
    }

}