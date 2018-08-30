<?php

abstract class AbstractModel
{
    protected static $tableName;
    protected static $className = 'stdClass';


    public static function getAll(){

        $db = new DB;
        $db->setClassName(static::$className);

        $stm = $db->queryAll('SELECT * FROM '. static::$tableName);
        return $stm;
    }


    public static function getAllOrder($tname, $ord = 'DESC'){

        $db = new DB;
        $db->setClassName(static::$className);
        $sql = 'SELECT * FROM '. static::$tableName.' ORDER BY '.$tname.' '.$ord.'';

        $stm = $db->queryAll($sql);
        return $stm;
    }


    public static function getOne($id){
        $db = new DB;
        $db->setClassName(static::$className);

        // МНЕ НЕ НРАВИТСЯ ЭТА КОНСТРУКЦИЯ, НЕТ ГИБКОСТИ!!!!!!!!!!!!!!!!!!!!!!!!


        $res = $db->queryOne('SELECT * FROM '.static::$tableName.' WHERE id=:id', [':id'=>$id]);
        return $res;
    }


    public static function insert($obj)
    {

        $db = new DB;

        $params = [];
        $arr = [];
        $arr1 = [];

        foreach ($obj as $key => $item) {
            if (!empty($item)) {
                $arr[] = $key;
                $arr1[] = ':' . $key;
                $params[':' . $key] = $item;
            }
        }

        $tnames = implode(", ", $arr);
        $values = implode(", ", $arr1);

        $sql = "INSERT INTO " . static::$tableName . " (" . $tnames . ") VALUES (" . $values . ")";
        $res = $db->queryIns($sql, $params);

        return $res;
    }


}