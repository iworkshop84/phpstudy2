<?php

require __DIR__ . '/autoload.php';

$ctrl = isset($_GET['ctrl']) ? $_GET['ctrl'] : 'News';
$act = isset($_GET['act']) ? $_GET['act'] : 'All';


$ctrlClassName = $ctrl . 'Controller';

$controller = new $ctrlClassName;
$method = 'action' . $act;
$controller->$method();