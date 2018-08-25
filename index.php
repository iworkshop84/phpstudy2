<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'sql.php';

if (!empty($_POST) && isset($_POST['nPost'])){
    if(empty($_POST['nName']) || empty($_POST['nText'])){
        $error = 'Введите название и текст новости';
    }else{
        $post = newsPost(dbLink(), $_POST);
        if($post){
            header('Location: http://mysite.loc/');
            exit;
        }
    }
}


if (isset($_GET['id'])){
    $row = singleNews(dbLink(), $_GET['id']);
    if (!isset($row)){
        header('Location: http://mysite.loc/');
        exit;
    }
}

$allNews = bdSelect(dbLink());


if(empty($_GET)){
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'allnews.php';
}
elseif(isset($_GET['addnews']) && ($_GET['addnews'] == 'yes')){
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'addnews.php';
}
elseif(isset($_GET['id'])){
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'single.php';
}
else{
    header('Location: http://mysite.loc/');
    exit;
}