<?php

class E404Ecxeption
    extends Exception
{

    public function logFile(){

        if(!file_exists(__DIR__ . '../log.txt')){
            file_put_contents('log.txt', 'Date:' . date('H:m:s m.d.Y', time()) .' '. $this->getMessage().
                ' FILE:' .$this->getFile().
                ' Line:' .$this->getLine() . PHP_EOL, FILE_APPEND);
        }
    }
}