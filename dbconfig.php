<?php
function dbLink(){

    $dbHost = 'localhost';
    $dbName = 'nsite';
    $dbUser = 'root';
    $dbPass = '';

    $dbLink = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
    if (!$dbLink) {
        die('Ошибка подключения (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
    }
    return $dbLink;

}