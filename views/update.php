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
        <a href="/index.php?addnews=yes">Добавление новости</a>

    </div>





    <div style="margin-left: auto; margin-right: auto; width: 600px ">

        <form id="nPost" action="/?update=<?php
        if(isset($news)){
            echo $news->id;
        }
        ?>" method="post" enctype="application/x-www-form-urlencoded">
            <input type="text" name="uName" placeholder="Введите название" value="<?php
            if(isset($news)){
                echo $news->nname;
            }
            ?>"/><br/>
            <textarea name="uText" rows="20" cols="60" placeholder="Введите текст"><?php
                if(isset($news)){
                    echo $news->ntext;
                }
                ?></textarea><br/>
            <input type="submit" name="uPost" value="Обновить запись">
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