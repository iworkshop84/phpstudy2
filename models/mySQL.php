<?php

/**
 * Created by PhpStorm.
 * User: iworkshop
 * Date: 26.08.2018
 * Time: 17:04
 */
class mySQL extends PDO{

        function __construct()
        {
            $opt = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false
            ];
            parent::__construct('mysql:dbname=nsite;host=localhost', 'root', '', $opt );
        }


        function showAll(){
            return $this->query('SELECT * FROM news ORDER BY ndate DESC');
        }


        function showOne($id){
            $row = $this->query('SELECT * FROM news WHERE id="'.$id.'"');
            $row ->setFetchMode(PDO::FETCH_CLASS, 'News');
            while ($new = $row->fetch())
            {
                return $new;
            }

        }

        function insNews($news){
            $this->query("INSERT INTO news (nname, ntext, ndate) VALUES (
                                              '".$news->nname."', '".$news->ntext."', CURRENT_TIMESTAMP)");

            return $this->lastInsertId();

        }

        function updateNews($obj){
            $row = $this->query("UPDATE news SET nname='".$obj->nname."', ntext='".$obj->ntext."' WHERE id='".$obj->id."'");
            return $row;
        }



}