<?php

class Public_Model_Country extends Com_Module_Model {

    /**
     *
     * @return Public_Model_Country 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function getList($pattern) {
        $db = new Entities_Country();
        return $db->getAll($db->getListForAutocomplete()->where("LOWER(CouName) like LOWER('{$pattern}%')"));
    }

    public function getByCode($code) {
        $db = new Entities_Country();
        $db->CouCode = $code;
        $db->get();
        return $db;
    }

}
