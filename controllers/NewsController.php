<?php


class NewsController
{

    public function actionAll(){

        $news = News::getAllOrder('ndate');

        include __DIR__ . '/../views/all.php';
    }

    public function actionOne(){

        $id = $_GET['id'];
        $item = News::getOne($id);

        include __DIR__ . '/../views/one.php';
    }
}