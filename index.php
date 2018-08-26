<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'mySQL.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'Article.php';
//require_once __DIR__ . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'SafeMySQL.php';


if (!empty($_POST) && isset($_POST['nPost'])){
    if(empty($_POST['nName']) || empty($_POST['nText'])){
        $error = 'Введите название и текст новости';
    }else{

        $art = new News();
        $art->nname = $_POST['nName'];
        $art->ntext = $_POST['nText'];

        $db = new mySQL();
        $postId = $db->insNews($art);

        if($postId){

            header('Location: http://mysite.loc/?update='.$postId);
            exit;
        }
    }
}


if (isset($_GET['id'])){
    $db = new mySQL();
    $news = $db->showOne($_GET['id']);

    if (!isset($news)){
        header('Location: http://mysite.loc/');
        exit;
    }
}




if (isset($_GET['update']) && empty($_POST['uPost'])){
    $db = new mySQL();
    $news = $db->showOne($_GET['update']);
}elseif (isset($_GET['update']) && !empty($_POST['uPost'])){
    $db = new mySQL();

    $news = new News();
    $news->id = $_GET['update'];
    $news->nname = $_POST['uName'];
    $news->ntext = $_POST['uText'];

    $res = $db->updateNews($news);

}


$db = new mySQL();
$allNews = $db->showAll();



if(empty($_GET)){
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'allnews.php';
}
elseif(isset($_GET['addnews']) && ($_GET['addnews'] == 'yes')){
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'addnews.php';
}
elseif(isset($_GET['update'])){
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'update.php';
}
elseif(isset($_GET['id'])){
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'single.php';
}
else{
    header('Location: http://mysite.loc/');
    exit;
}