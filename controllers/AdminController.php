<?php


class AdminController
{

    public function actionAdd(){

        if (!empty($_POST)){
            if(empty($_POST['nname']) || empty($_POST['ntext'])){
                $error = 'Введите название и текст новости';
            }else{

            $news = new News();
            $news->nname = $_POST['nname'];
            $news->ntext = $_POST['ntext'];
            $news->ndate = time();

            $item = News::insert($news);

            }
        }


        include __DIR__ . '/../views/add.php';
    }

}