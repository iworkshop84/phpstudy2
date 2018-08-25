<?php

require_once __DIR__ .  '/../dbconfig.php';


function bdSelect($dbLink){
    $result =  mysqli_query($dbLink,"SELECT * FROM news ORDER BY ndate DESC");
    if(!$result){
        return 'Ошибка запроса!';
    }else{
        return $result;
    }
}


function newsPost($dbLink, $nArray){
    $result =  mysqli_query($dbLink,"INSERT INTO news (nname, ntext, ndate) VALUES (
                                              '".$nArray['nName']."', '".$nArray['nText']."', CURRENT_TIMESTAMP)");
    if(!$result){
        return 'Ошибка запроса!';
    }else{
        return $result;
    }
}

function singleNews($dbLink, $id){
    $result =  mysqli_query($dbLink,"SELECT * FROM news WHERE id='".$id."'");
    if(!$result){
        return 'Ошибка запроса!';
    }else{
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
}

