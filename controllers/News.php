<?php
namespace App\Controllers;

use App\Models\News as NewsModel;
use App\Classes\View;
use App\Classes\E404Ecxeption;

class News
{

    public function actionAll(){

        $news = NewsModel::getAllOrder('ndate');
        if(empty($news)){
            $err = new E404Ecxeption('Записей нет' , 404);
            throw $err;
        }

        $view = new View();
        $view->items = $news;
        $view->display('all.php');
    }

    public function actionOne($id = null){

        $news = NewsModel::findOneById($id);
        if(!$news){
            $err = new E404Ecxeption('Запись не найдена' , 404);
            throw $err;
        }

        $view = new View();
        $view->item = $news;
        $view->display('one.php');
    }

}