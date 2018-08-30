<?php

class DB
{
    private $dbh;
    public $className = 'stdClass';

    function __construct(){
       $this->dbh = new PDO("mysql:host=localhost;dbname=nsite;charset=utf8", 'root', '');
    }

    public function setClassName($className)
    {
        $this->className = $className;
    }

    public function queryAll($sql, $params=[]){

        $stm = $this->dbh->prepare($sql);
        $stm->execute($params);
        return $stm->fetchAll(PDO::FETCH_CLASS, $this->className);
    }

    public function queryOne($sql, $params=[]){

        $stm = $this->dbh->prepare($sql);
        $stm->execute($params);
        $stm->setFetchMode(PDO::FETCH_CLASS, $this->className);
        return $stm->fetch();
    }

    public function queryIns($sql, $params=[]){

        $stm = $this->dbh->prepare($sql);
        $stm->execute($params);
        return $this->dbh->lastInsertId();
    }
}