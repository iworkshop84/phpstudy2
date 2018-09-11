<?php

class DB
{
    private $dbh;
    private $className = 'stdClass';

    function __construct(){
        try {
        $opt = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ];
        $this->dbh = new PDO("mysql:host=localhost;dbname=nsite;charset=utf8", 'root', '', $opt);
        }
        catch (PDOException $e) {
            $err = new E404Ecxeption('Ошибка соединения с базой данных: <br/>'. $e->getMessage() , $e->getCode());
            throw $err;
        }
    }


    public function setClassName($className)
    {
        $this->className = $className;
    }

    public function queryAll($sql, $params=[]){
        try{
        $stm = $this->dbh->prepare($sql);
        $stm->execute($params);
        $res = $stm->fetchAll(PDO::FETCH_CLASS, $this->className);
        }
        catch (PDOException $e) {
            $err = new E404Ecxeption('Ошибка запроса: <br/>'. $e->getMessage() , $e->getCode());
            throw $err;
        }
        return $res;
    }

    public function queryOne($sql, $params=[]){
        try{
        $stm = $this->dbh->prepare($sql);
        $stm->execute($params);
        $stm->setFetchMode(PDO::FETCH_CLASS, $this->className);
        $res = $stm->fetch();
        }
        catch (PDOException $e) {
            $err = new E404Ecxeption('Ошибка запроса: <br/>'. $e->getMessage() , $e->getCode());
            throw $err;
        }
        return $res;
    }

    public function queryIns($sql, $params=[]){

        $stm = $this->dbh->prepare($sql);
        $stm->execute($params);
        return $this->dbh->lastInsertId();
    }

    public function execute($sql, $params=[]){

        $stm = $this->dbh->prepare($sql);
        $res = $stm->execute($params);

        if($res){
            return $this->dbh->lastInsertId();
        }else{
            return $res;
        }
    }

    public function lastInsertId(){

        return $this->dbh->lastInsertId();
    }

}