<?php
/**
 * User: lhaos
 * Date: 29/04/2016
 */

//echo "<pre>";
//print_r($_SERVER);
//echo "</pre>";die;

header("Content-type: text/html; charset=utf-8");
    date_default_timezone_set("America/Sao_Paulo");
    ini_set('allow_url_fopen', 1);

    $pathRaiz = realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..');
    $pathRaiz = rtrim($pathRaiz, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

    if ($pathRaiz != (rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR)) . DIRECTORY_SEPARATOR) {
        $docRoot = $_SERVER['DOCUMENT_ROOT'];

        // Remove o DIRECTORY_SEPARATOR do final da string se tiver e o inclui
        $docRoot = rtrim($docRoot, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

        $PATH = str_replace($docRoot, '', $pathRaiz);

        // Remove o DIRECTORY_SEPARATOR do inicio da string se tiver e o inclui
        $PATH = DIRECTORY_SEPARATOR . ltrim($PATH, DIRECTORY_SEPARATOR);
        // Remove o DIRECTORY_SEPARATOR do final da string se tiver e o inclui
        $PATH = rtrim($PATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    } else {
        $PATH = DIRECTORY_SEPARATOR;
    }

    if (isset($_SERVER['REQUEST_SCHEME'])) {
        $protocol = $_SERVER['REQUEST_SCHEME'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
        $protocol = $_SERVER['HTTP_X_FORWARDED_PROTO'];
    } else {
        $protocol = 'http';

        if ($_SERVER["SERVER_PORT"] == 443) { // protocolo https
            $protocol .= 's';
        }
    }//fecha else

    $urlSite = rtrim(str_replace(DIRECTORY_SEPARATOR, '/', $_SERVER['HTTP_HOST'] . $PATH), '/');
    define("URLSITE", $urlSite);

    //echo "server=".$_SERVER['SERVER_NAME'];
    if (isset($_SERVER['SCRIPT_URL']) && strpos($_SERVER['SCRIPT_URL'], '~') !== FALSE) {
        $auxServer = explode('/', $_SERVER['SCRIPT_URL']);
        define('GLOBAL_PATH', $protocol . '://' . $_SERVER['HTTP_HOST'] . '/' . $auxServer[1] . $PATH);
    } else {
        define('GLOBAL_PATH', $protocol . '://' . $_SERVER['HTTP_HOST'] . $PATH);
    }//fecha else

    if ($_SERVER['SERVER_PORT'] != '80') {
        $PATH2 = preg_replace('%:'.$_SERVER['SERVER_PORT'].'%', '', $PATH);
        define('LOCAL_PATH', $_SERVER['DOCUMENT_ROOT'] . $PATH2);
    } else {
        define('LOCAL_PATH', $_SERVER['DOCUMENT_ROOT'] . $PATH);
    }//fecha else


    define("CLASS_PATH", LOCAL_PATH . "src/");
    define("APPLICATION", LOCAL_PATH . "admin/applicatio$n/");
    define("CONFIG_PATH", LOCAL_PATH, "config/");

    spl_autoload_register('autoLoad');

    function autoLoad($classe) {

        if (file_exists(CLASS_PATH . "default/" . $classe . ".php"))
            require_once(CLASS_PATH . "default/" . $classe . ".php");
        else {
            $erro = 0;

            $dir = strtolower($classe);
            if (substr($dir, 0, 3) == 'sql') {
                $dir = substr($dir, 3);
            }

            if ($dir != "") {
                if (file_exists(APPLICATION . $dir . '/class/' . $classe . '.php')) {
                    $erro = 0;
                    require_once(APPLICATION . $dir . '/class/' . $classe . '.php');
                    return;
                } else
                    $erro = 1;
            }

            if ($erro == 1)
                die("Erro ao acessar a classe " . $classe);
        }
    }
