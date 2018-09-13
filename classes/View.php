<?php

namespace App\Classes;

class View
    implements \Iterator
{
    protected $data = [];


    public function __set($key,$value){
        $this->data[$key] = $value;
    }

    public function __get($key)
    {
        return  $this->data[$key];
    }


    public function render($template){

        foreach ($this->data as $key=>$val){
            $$key = $val;
        }
        ob_start();
        include __DIR__ . '/../views/' . $template;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }


    public function display($template){
        echo $this->render($template);
    }
/*
    public function assign($name, $value){
        $this->data[$name] = $value;
    }
*/

// Итератор для работы с объектом как с массивом
    public function current()
    {
        $data = current($this->data);
        return $data;
    }


    public function next()
    {
        $data = next($this->data);
        return $data;
    }


    public function key()
    {
        $data = key($this->data);
        return $data;
    }


    public function valid()
    {
        $key = key($this->data);
        $data = ($key !== NULL && $key !== FALSE);
        return $data;
    }


    public function rewind()
    {
        reset($this->data);
    }
}