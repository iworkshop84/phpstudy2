<?php


class AdminController
{

    public function actionAdd(){

        if (!empty($_POST)){

            if(isset($_POST['delete']) && !empty($_POST['id'])){
                $news = new News();
                $news->fill($_POST);
                $news->delete();

                header('Location: /index.php?ctrl=Admin&act=Add');
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