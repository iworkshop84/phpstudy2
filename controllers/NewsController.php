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

        $news = News::findOneById($_GET['id']);

        $view = new View();
        $view->item = $news;
        $view->display('one.php');
    }

}