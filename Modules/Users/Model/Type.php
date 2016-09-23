<?php

class Users_Model_Type extends Com_Module_Model {

    /**
     *
     * @return Users_Model_Type
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function getList() {
        $type = new Entities_Type();
        return $type->getAll($type->getList());
    }

}
