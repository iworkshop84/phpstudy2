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

        $sql = 'SELECT * FROM '.static::$tableName.' WHERE id=:id';
        return $db->queryOne($sql, [':id'=>$id]);
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
        $db->execute($sql, $data);
        return $db->lastInsertId();
    }


    protected function update(){

        $ins =[];
        $cools =[];
        foreach ($this->storage as $key=>$val){
            $ins[':' . $key] = $val;
            if('id' == $key){
                continue;
            }
            $cools[] = $key .' = :' . $key;
        }

        $sql = 'UPDATE '. static::$tableName .' 
        SET
        '. implode(', ', ($cools)) .'
        WHERE id=:id';

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
        $ins =[];
        foreach ($this->storage as $key=>$val){
            if('id' == $key){
                $ins[':id'] = $val;
            }
        }

        $sql = 'DELETE FROM '. static::$tableName .' 
        WHERE 
        id=:id';

        $db = new DB();
        return $db->execute($sql, $ins);
    }


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

    /*
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
    */

}