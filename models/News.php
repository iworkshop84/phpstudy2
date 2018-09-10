<?php

/**
 * Class News
 * @property $id
 * @property $nname
 * @property $ntext
 * @property $ndate
 */
class News
    extends AbstractModel
{
    /*
    public $id;
    public $nname;
    public $ntext;
    public $ndate;
*/
    protected static $tableName = 'news';

    public function save(){
        if(!isset($this->id)){
            $this->ndate = time();
            return $this->id = $this->insert();
        }else{
            return $this->update();
        }
    }
}