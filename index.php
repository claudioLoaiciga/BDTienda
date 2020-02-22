<?php
session_start();
require_once 'model/database.php';

$sessionInit = FALSE;
$controller = 'login';

if(isset($_SESSION['Iniciada'])){
    $sessionInit=true;
}
if(isset($_REQUEST['c'])){
    $controller = strtolower($_REQUEST['c']);
}

if (!isset($_SESSION['tiempo'])) {
    $_SESSION['tiempo']=time();
}
else if (time() - $_SESSION['tiempo'] > 600) {
    session_destroy();
    $sessionInit=false;
}
$_SESSION['tiempo']=time();




// Todo esta lógica hara el papel de un FrontController

if ($sessionInit || strcmp($controller, "login") === 0) {
// Todo esta lógica hara el papel de un FrontController
    if (!isset($_REQUEST['c'])){
        require_once "controller/$controller.controller.php";
        $controller = ucwords($controller) . 'Controller';
        $controller = new $controller;
        $controller->Index();
    } else {
        // Obtenemos el controlador que queremos cargar
        $controller = strtolower($_REQUEST['c']);
        $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';

        // Instanciamos el controlador
        require_once "controller/$controller.controller.php";
        $controller = ucwords($controller) . 'Controller';
        $controller = new $controller;

        // Llama la accion
        call_user_func(array($controller, $accion));
    }
}
else {

    //Probar commint
        $controller = 'login';
    require_once "controller/$controller.controller.php";
        $controller = ucwords($controller) . 'Controller';
        $controller = new $controller;
        $controller->Index();
}
