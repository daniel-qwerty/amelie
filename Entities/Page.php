<?php

class Entities_Page extends Com_Database_Entity_Language {

    public $tableName = "Page";
    public $keyField = "PagId";
    public $lanField = "PagLanId";
    public $PagId;
    public $PagLanId;
    public $PagName;
    public $PagUrl;
    public $PagMetaTags;
    public $PagDescription;
    public $PagAditional;
    public $PagContent;
    public $PagHome;
    public $PagStatus;
    public $PagLayout;
    public $PagImage;

    public function funGetList() {
        return Com_Database_Query::getInstance()->select()
                        ->from($this)
                        ->orderBy("PagName");
    }

}
