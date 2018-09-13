<?php

namespace App\Controllers;

use App\Models\News;
use App\Classes\View;

class Admin
{

    public function actionAdd(){

        if (!empty($_POST)){

            if(isset($_POST['delete']) && !empty($_POST['id'])){
                $news = new News();
                $news->fill($_POST);
                $news->delete();

                header('Location: /admin/add');
                exit;
            }


            if(empty($_POST['nname'])){
                $error = 'Введите название и текст новости';
            }else{
            $news = new News();
            $news->fill($_POST);
            $news->save();
            }
        }

        $view = new View();
        if(isset($news)){
            $view->item = $news;
        }
        $view->display('add.php');
    }

}