<?php


class Entities_Configuration extends Com_Database_Entity{
    
    public $tableName = "Configuration";
    public $keyField = "ConId";
    public $ConId;
    public $ConKey;
    public $ConAlias;
    public $ConValue;
    
    public function funGetList(){
        return Com_Database_Query::getInstance()->select()
                    ->from($this)
                    ->orderBy("ConId");
    }
    
}