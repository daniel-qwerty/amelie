<?php

class Entities_Language extends Com_Database_Entity {

    public $tableName = "Language";
    public $keyField = "LanId";
    public $LanId;
    public $LanCode;
    public $LanName;
    public $LanDefault;

    public function getList() {
        return Com_Database_Query::getInstance()->select()
                        ->from($this)
                        ->orderBy("LanDefault desc")
                        ->orderBy("LanName");
    }

}
