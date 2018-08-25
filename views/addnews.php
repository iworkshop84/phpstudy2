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

        <form id="nPost" action="/index.php?addnews=yes" method="post" enctype="application/x-www-form-urlencoded">
            <input type="text" name="nName" placeholder="Введите название"/><br/>
            <textarea name="nText" rows="20" cols="60" placeholder="Введите текст"></textarea><br/>
            <input type="submit" name="nPost" value="Опубликовать">
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