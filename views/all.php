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
        <a href="/index.php?ctrl=Admin&act=Add">Добавить новость</a>

    </div>



    <?php foreach($news as $items): ?>
        <div style="float: left; width: 100%">
            <?= date("d-m-Y H:i:s", $items->ndate), '<br/>' ;?>
            <a href="<?= '/index.php?ctrl=News&act=One&id='.$items->id; ?>"> <?php echo($items->nname), '<br/>';?></a>
            <?php echo($items->ntext), '<br/><br/>';?>

        </div>

    <?php endforeach;?>

</div>
</body>
</html>