<?php

class Entities_Client extends Com_Database_Entity{

    public $tableName = "Client";
    public $keyField = "CliId";
    
    public $CliId;
    public $CliName;
    public $CliCi;
    public $CliCity;
    public $CliPhone;
    public $CliEmail;
    public $CliCupon;
    public $CliStatus;
   
}
