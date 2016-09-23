<?php

class Entities_SlideShow extends Com_Database_Entity_Language {

    public $tableName = "SlideShow";
    public $keyField = "SliId";
    public $lanField = "SliLanId";
    
    public $SliId;
    public $SliLanId;
    public $SliTitle;
    public $SliDescription;
    public $SliImage;
    public $SliLink;
    public $SliStatus;

}
