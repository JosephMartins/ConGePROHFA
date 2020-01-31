<?php

@session_start();
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

/* * *********** CONSTANTES BANCO ********** */
define('B_HOST', 'localhost');
define('B_USUARIO', 'root');
define('B_SENHA', '');
define('B_BANCO', 'hfa');

/* * ******* CONSTANTES CAMADA - VISAO E REDIRECIONAMENTO ******* */
$PROTOCOLO = (strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') == true) ? 'https' : 'http';
define('PROTOCOLO', $PROTOCOLO);
define('DIR', '/frame_atualizado/');

define('SERVER', $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT']);
define('RAIZ', PROTOCOLO . '://' . SERVER . DIR);

define('CSS', RAIZ . 'public/css/');
define('JS', RAIZ . 'public/js/');
define('IMG', RAIZ . 'public/img/');
define('PUBLICO', RAIZ . 'public/');
define('APPLICATION', RAIZ . 'application/');

define('HELPER', 'application/helper/');
define('CONTROLLER', RAIZ . 'controller/');

$_SESSION['PATH'] = $_SERVER['DOCUMENT_ROOT'] . str_replace(':84', '', DIR);
?>