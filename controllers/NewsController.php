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

        $id = $_GET['id'];
        $news = News::getOne($id);

        $view = new View();
        //$view->assign('item', $item);
        $view->item = $news;
        $view->display('one.php');
    }

}