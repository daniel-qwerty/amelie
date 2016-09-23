<?php

class Entities_Contact extends Com_Database_Entity_Language {

    public $tableName = "Contact";
    public $keyField = "ConId";
    public $lanField = "ConLanId";
    
    public $ConId;
    public $ConLanId;
    public $ConDate;
    public $ConEmail;
    public $ConName;
    public $ConMessage;
    public $ConStatus;

}
