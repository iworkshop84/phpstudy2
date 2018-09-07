<?php


abstract class AbstractModel

{
    protected static $tableName;
    protected static $className = 'stdClass';

    protected $storage = [];


    public function __set($key, $value)
    {
        $this->storage[$key] = $value;
    }

    public function __get($key)
    {
        return  $this->storage[$key];
    }

    public function __isset($value)
    {
        return isset($this->storage[$value]);
    }

    public function __unset($key)
    {
        unset($this->storage[$key]);
    }



    public static function getAll()
    {
        $db = new DB;
        $db->setClassName(get_called_class());

        $stm = $db->queryAll('SELECT * FROM '. static::$tableName);
        return $stm;
    }


    public static function getAllOrder($tname, $ord = 'DESC')
    {
        $db = new DB;
        $db->setClassName(get_called_class());

        $sql = 'SELECT * FROM '. static::$tableName.' ORDER BY '.$tname.' '.$ord.'';
        $stm = $db->queryAll($sql);
        return $stm;
    }


    public static function findOneById($id){
        $db = new DB;
        $db->setClassName(get_called_class());

        $res = $db->queryOne('SELECT * FROM '.static::$tableName.' WHERE id=:id', [':id'=>$id]);
        return $res;
    }


    public static function findOneByColumn($column, $value){
        $db = new DB;
        $db->setClassName(get_called_class());

        $sql = 'SELECT * FROM '.static::$tableName.' WHERE '.$column.'=:'.$column;
        return $db->queryOne($sql, [':'.$column=>$value]);

    }


    protected function insert(){

        $cols = array_keys($this->storage);
        $data = [];

        foreach ($cols as $col){
            $data[':' . $col] = $this->storage[$col];
        }

        $sql = "INSERT INTO " . static::$tableName . " 
        (" . implode(", ", $cols) . ") 
        VALUES
         (" . implode(", ", array_keys($data)) . ")";

        $db = new DB;
        return $db->execute($sql, $data);
    }


    protected function update(){

        $arr = $this->storage;
        // делаем массив для подготовленного выражения
        $ins =[];
        $rools =[];
        foreach ($arr as $key=>$val){
            $ins[':' . $key] = $val;
            $rools[$key] = $key .' = :' . $key;
        }
        // Удаляем из массива условий ключ id(он у нас всегда будет идти в свойствах первый)
        $where = array_shift($rools);

        $sql = 'UPDATE '. static::$tableName .' 
        SET
        '. implode(', ', ($rools)) .'
        WHERE 
        ('. $where .')';

        $db = new DB();
        return $db->execute($sql, $ins);
    }


    public function save(){
        if(!isset($this->id)){
            return $this->id = $this->insert();
        }else{
            return $this->update();
        }
    }

    public function delete()
    {
        $arr = $this->storage;
        $ins =[];
        $params =[];
        foreach ($arr as $key=>$val){
            $ins[':' . $key] = $val;
            $params[$key] = $key .' = :' . $key;
        }
        $where = array_shift($params);
        $par = array_slice($ins, 0, 1);

        $sql = 'DELETE FROM '. static::$tableName .' 
        WHERE 
        ('. $where .')';

        $db = new DB();
        return $db->execute($sql, $par);
    }


    /*
    public function save(){
        if (isset($this->id)) {
        echo 'Тут будет обновление';
        die;

        }else{
            $cols = array_keys($this->storage);
            $data = [];

            foreach ($cols as $col){
                $data[':' . $col] = $this->storage[$col];
            }

            $sql = "INSERT INTO " . static::$tableName . " 
        (" . implode(", ", $cols) . ") 
        VALUES
         (" . implode(", ", array_keys($data)) . ")";

            $db = new DB;
            return $db->execute($sql, $data);
        }
    }
*/


    public function fill($arr){
        foreach ($arr as $k=>$v){
            if(!empty($v)){
                $this->__set($k, $v);
            }
        }
    }


/* Мой старый метод инсёрт под статику
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
*/


}