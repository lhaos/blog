<?php

/**
 * User: lhaos
 * Date: 29/04/2016
 */
class User extends Mapper{

    public static function login($user, $password){

        try{
            $conn = Conection::con();
            $stat = $conn->prepare("select * from `user` where (username = ? or email = ?) and `password`= md5(?) and actived = 1 limit 1");
            $stat->bindValue(1, $user);
            $stat->bindValue(2, $user);
            $stat->bindValue(3, $password);

            $stat->execute();

            $arrayDados = $stat->fetchAll(PDO::FETCH_ASSOC);

            if(is_array($arrayDados) && count($arrayDados) > 0){
                $_SESSION['adm']['username'] = $arrayDados[0]->username;
                $_SESSION['adm']['email'] = $arrayDados[0]->email;
                $_SESSION['adm']['nick'] = $arrayDados[0]->nick;
                $_SESSION['adm']['id'] = $arrayDados[0]->id;

                return true;
            }else{
                throw(new Exception("User or password invalid"));
            }


        }catch (Exception $e){
            return $e->getMessage();
        } catch (PDOException $pe) {
            echo $pe->getCode() . " - " . $pe->getMessage();
            die;
        }

    }//fecha metodo de login

    public static function logout(){
        session_start();
        unset($_SESSION['adm']);

        header("location:".GLOBAL_PATH."admin/");
        die;
    }//fecha metodo de logout

}//fecha class