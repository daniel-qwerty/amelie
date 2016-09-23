<?php

class Statistics_Model_Visit extends Com_Module_Model {

    /**
     *
     * @return Statistics_Model_Visit 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    /**
     *
     * @param String $strIp
     * @param String $dtaDate
     * @param String $tmpTime
     * @param String $strUrl 
     */
    public function doInsert($strIp, $dtaDate, $tmpTime, $strUrl, $lanId, $countryId) {
        $db = new Entities_Visit();
        $db->VisIp = $strIp;
        $db->VisDate = $dtaDate;
        $db->VisTime = $tmpTime;
        $db->VisUrl = $strUrl;
        $db->VisLanId = $lanId;
        $db->VisCouId = $countryId;
        $db->action = ACTION_INSERT;
        $db->save();
    }

    public function getList($dtaStart, $dtaEnd) {
        $db = new Entities_Visit();

        return $db->getAll($db->getList($dtaStart, $dtaEnd)->limit(0, 10000));
    }

    public function count() {
        $db = new Entities_Visit();
        return $db->getAll("select count(*) as cantidad from {$db}");
    }

    public function countUnique() {
        $db = new Entities_Visit();
        return $db->getAll("select count(*) as cantidad from (select distinct VisIP from Visit where VisUrl like '%Salvando%' or VisUrl like '%testimonio%' or VisUrl like '%articlesv%' or VisUrl like '%pregunta%') as ips");
    }

}
