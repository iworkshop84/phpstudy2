<?php

require __DIR__ . '/autoload.php';

$ctrl = isset($_GET['ctrl']) ? $_GET['ctrl'] : 'News';
$act = isset($_GET['act']) ? $_GET['act'] : 'All';


$ctrlClassName = $ctrl . 'Controller';

try{
    $controller = new $ctrlClassName;
    $method = 'action' . $act;
    $controller->$method();
}
catch (E404Ecxeption $err){
    $err->logFile();
    $view = new View();
    $view->error = $err->getMessage();
    $view->code = $err->getCode();

    switch ($view->code){
        case 404:
            header("HTTP/1.0 404 Not Found");
            break;
        case 1045:
            header("HTTP/1.0 403 Not Found");
            break;
        case 1049:
            header("HTTP/1.0 403 Not Found");
            break;
        case 2002:
            header("HTTP/1.0 403 Not Found");
            $view->error = 'Неправильное имя сервера БД<br/>' .$err->getMessage();
            break;
        default:
            header("HTTP/1.0 404 Not Found");
            break;

    }
    $view->display('error.php');
}