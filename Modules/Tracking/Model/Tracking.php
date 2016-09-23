<?php

class Tracking_Model_Tracking extends Com_Module_Model {

    /**
     *
     * @return Tracking_Model_Tracking
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
    public function doInsert($strRemoteIp, $strPage, $strOriginPage, $strActualPage, $strDate, $strTime, $strBrowser) {
        $db = new Entities_Tracking();
        $db->TraBrowser = $strBrowser;
        $db->TraDate = $strDate;
        $db->TraTime = $strTime;
        $db->TraOriginPage = $strOriginPage;
        $db->TraActualPage = $strActualPage;
        $db->TraPage = $strPage;
        $db->TraRemoteIp = $strRemoteIp;
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
