<?php

class Entities_Type extends Com_Database_Entity {

    public $tableName = "Type";
    public $keyField = "TypId";
    public $TypId;
    public $TypName;

    public function funGetList() {
        return Com_Database_Query::getInstance()->select()
                        ->from($this)
                        ->orderBy("TypName");
    }

}
