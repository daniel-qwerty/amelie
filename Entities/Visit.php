<?php

class Entities_Visit extends Com_Database_Entity {

    public $tableName = "Visit";
    public $keyField = "VisId";
    public $VisId;
    public $VisIp;
    public $VisDate;
    public $VisTime;
    public $VisUrl;
    public $VisLanId;
    public $VisCouId;

    public function getLista($dtaStart, $dtaEnd) {
        $language = new Entities_Language();
        $country = new Entities_Country();

        return Com_Database_Query::getInstance()->select(array("distinct LanName,CouName,DATE_FORMAT(VisDate,'%d/%m/%Y') as VisDate,VisUrl,VisIp,count(*) as Cantidad"))
                        ->from($this)
                        ->innerJoin($language, "LanId=VisLanId")
                        ->innerJoin($country, "CouId=VisCouId")
                        ->where("DATE_FORMAT(VisDate,'%Y-%m-%d')>='{$dtaStart}'")
                        ->andWhere("DATE_FORMAT(VisDate,'%Y-%m-%d')<='{$dtaEnd}'")
                        ->groupBy("DATE_FORMAT(VisDate,'%Y-%m-%d'),VisUrl")
                        ->orderBy("DATE_FORMAT(VisDate,'%Y-%m-%d') desc,VisUrl");
    }

}
