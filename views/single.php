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

    <div style="float: left; width: 100%">
        <?php echo($row['ndate']), '<br/>';?>
        <b><?php echo($row['nname']), '<br/>';?></b>
        <?php echo($row['ntext']), '<br/><br/>';?>

    </div>

</div>
</body>
</html>