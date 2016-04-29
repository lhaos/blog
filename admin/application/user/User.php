<?php

/**
 * User: lhaos
 * Date: 29/04/2016
 */
class User extends Mapper{

    public static function login($user, $password){

        try{
            $stat = Conection::con()->prepare("select * from user where (userName = ? or email = ?) and senha = ?");
            $stat->bindvalue(1, $user);
            $stat->bindvalue(2, $user);
            $stat->bindvalue(3, $password);

            $stat->execute();

            $array = $stat->fechtAll(PDO::FETCH_ASSOC);

            return $array;
        }catch (Exception $e){
            echo "Usuario ou senha invalidos";
        }//fecha catch

    }//fecha metodo de login

}//fecha class