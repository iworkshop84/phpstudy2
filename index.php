<?php

require __DIR__ . '/autoload.php';

use App\Classes\E404Ecxeption;
use App\Classes\View;

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathParts = explode('/', $path);


$ctrl = !empty($pathParts[1]) ? $pathParts[1] : 'news';
$act = !empty($pathParts[2]) ? $pathParts[2] : 'all';
$id = !empty($pathParts[3]) ? $pathParts[3] : null;

// приводим строки к нужному нам виду, всё в нижний регистр, первый символ в верхний
$ctrl = ucfirst(mb_strtolower($ctrl));
$act = ucfirst(mb_strtolower($act));

/*
$ctrl = isset($_GET['ctrl']) ? $_GET['ctrl'] : 'News';
$act = isset($_GET['act']) ? $_GET['act'] : 'All';
*/




try{
    $ctrlClassName =  'App\\Controllers\\' . $ctrl;

    /*
    if(!class_exists($ctrlClassName)){
        throw new E404Ecxeption ('Такой страницы на сайте нет', 404);
    }
    */

    $controller = new $ctrlClassName;
    $method = 'action' . $act;

    if(!method_exists($controller, $method)){
        throw new E404Ecxeption ('Такой страницы на сайте нет', 1);
    }

    if(!empty($id))
    {
        $controller->$method($id);
    }else{
        $controller->$method();
    }
}
catch (E404Ecxeption | Exception $err){
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