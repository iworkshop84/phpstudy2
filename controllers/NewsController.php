<?php


class NewsController
{

    public function actionAll(){

        $news = News::getAllOrder('ndate');

        $view = new View();
        $view->items = $news;
        $view->display('all.php');
    }

    public function actionOne(){

        //$id = $_GET['id'];
        //$news = News::findById($_GET['id']);

        $news = News::findOneByColumn('id', $_GET['id']);

        $view = new View();
        $view->item = $news;
        $view->display('one.php');
    }

}