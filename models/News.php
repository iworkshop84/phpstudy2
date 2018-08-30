<?php

class News
    extends AbstractModel
{
    public $id;
    public $nname;
    public $ntext;
    public $ndate;

    protected static $tableName = 'news';
    protected static $className = 'News';





}