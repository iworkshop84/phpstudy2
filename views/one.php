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

    <div style="float: left; width: 100%">
        <?php echo ($item->ndate), '<br/>';?>
        <b><?php echo($item->nname), '<br/>';?></b>
        <?php echo($item->ntext), '<br/><br/>';?>

    </div>

</div>
</body>
</html>