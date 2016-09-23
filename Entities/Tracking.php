<?php

class Entities_Tracking extends Com_Database_Entity {

    public $tableName = "Tracking";
    public $keyField = "TraId";
    public $TraId;
    public $TraPage;
    public $TraOriginPage;
    public $TraActualPage;
    public $TraRemoteIp;
    public $TraBrowser;
    public $TraDate;
    public $TraTime;

}
