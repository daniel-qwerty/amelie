<?php

class Entities_Menu extends Com_Database_Entity_Language {

    public $tableName = "Menu";
    public $keyField = "MenId";
    public $lanField = "MenLanId";
    public $MenId;
    public $MenLanId;
    public $MenParentId;
    public $MenAlias;
    public $MenUrl;
    public $MenTarget;
    public $MenOrder;
    public $MenImage;
    public $MenDescription;
    public $MenStatus;
    public $MenX;
    public $MenY;
    public $MenW;
    public $MenH;

    public function getMenuList() {
        return Com_Database_Query::getInstance()->select()
                        ->from($this)
                        ->where("MenStatus=1")
                        ->orderBy("{$this}.MenOrder");
    }

   public function getWithParents() {
        $language = new Entities_Language();
        $parent = new Entities_Menu();
        $lanField = $this->lanField;
        return Com_Database_Query::getInstance()->select(array("{$language}.*", "parent.MenAlias as padre", "{$this}.*"))
                        ->from($this->tableName)
                        ->innerJoin($language, "LanId={$lanField}")
                        ->leftJoin($parent . " as parent", "{$this}.MenParentId=parent.MenId and {$this}.MenLanId=parent.MenLanId");
    }

}
