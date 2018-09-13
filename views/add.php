<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">

    <title>Новости</title>
</head>
<body>
<div style="margin-left: auto; margin-right: auto; width: 1300px ">
    <div style="font-size: 18px; margin-left: auto; margin-right: auto; width: 500px; padding: 30px 0 30px 0; ">
        <a href="/index.php">Главная</a>
        <a href="/admin/add">Добавить новость</a>

    </div>

    <div style="margin-left: auto; margin-right: auto; width: 600px ">

        <form id="nPost" action="/admin/add" method="post" enctype="application/x-www-form-urlencoded">
            <input type="hidden" name="id" value="<?php
            if(!empty($item->id)){
                echo $item->id;
            }
            ?>"/>
            <input type="text" name="nname" placeholder="Введите название" value="<?php
                        if(!empty($item->nname)){
                            echo $item->nname;
                        }
                        ?>"/><br/>
            <textarea name="ntext" rows="20" cols="60" placeholder="Введите текст"><?php
                if(!empty($item->ntext)){
                    echo $item->ntext;
                }
                ?></textarea><br/>

            <input type="submit" value="<?php
            if(!empty($item->id)){
                echo 'Обновить';
            }else{
                echo 'Опубликовать';
            }
            ?>"/>
            <button name="delete">Удалить</button>
        </form>

        <?php
        if(isset($error)){
            echo $error;
        }
        ?>

    </div>

</div>
</body>
</html>