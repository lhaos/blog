<?php

/**
 * User: lhaos
 * Date: 29/04/2016
 */
include_once '\config\db.php';

class Conection extends PDO{

    /**
     *
     * @var Array Serve como pool de conexoes de banco de dados
     */
    private static $con = array();

    /*
     *  Instancia a conexao com o banco de dados
     *
     *  @return Object Retorna um objeto para consultas e persistencia SQL
     */

    public static function con($config = 'default') {

        //se nao existir uma conexao aberta com a mesma configuracao
        if (!array_key_exists($config, self::$con)) {

            //carregando configuracao do APP
            $appConfiguration = require CONFIG_PATH . 'db.php';

            //se a configuracao passada por parametro nao existir
            //no arquivo de configuracao lanca uma excecao
            if (!array_key_exists($config, $appConfiguration)) {

                throw new Exception('Configuração de banco de dados não enconstrada');
            }

            $dbOptions = $appConfiguration[$config];

            self::$con[$config] = new \PDO($dbOptions['dsn'], $dbOptions['user'],
                $dbOptions['password'], array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

            //definindo o nivel de log dos erros
            self::$con[$config]->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_SILENT);
        }

        //retorna um Objeto PDO instanciado
        return self::$con[$config];
    }

}//fecha class