<?php

class Entities_Country extends Com_Database_Entity {

    public $tableName = "Country";
    public $keyField = "CouCode";
    public $CouCode;
    public $CouCode3;
    public $CouNumeric;
    public $CouFips;
    public $CouName;
    public $CouCapital;
    public $CouArea;
    public $CouPopulation;
    public $CouContinent;

    public function getList() {
        return Com_Database_Query::getInstance()->select()
                        ->from($this);
    }

    public function getListForAutocomplete() {
        return Com_Database_Query::getInstance()->select()
                        ->from($this);
    }

}
