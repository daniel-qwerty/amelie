<?php

class Configurations_Model_Configuration extends Com_Module_Model {

    /**
     *
     * @return Configurations_Model_Configuration
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doUpdate($lstItems) {
        $db = new Entities_Configuration();
        foreach ($lstItems as $strIndex => $varValue) {
            $strIndex = explode("--", $strIndex);
            $db->ConId = $strIndex[1];
            $db->ConValue = $varValue;
            $db->action = ACTION_UPDATE;
            $db->save();
        }
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Configuraci&oacute;n Actualizada");
    }

    public function getList() {
        $db = new Entities_Configuration();
        return $db->getAll($db->getList());
    }

    /**
     *
     * @param String $strKey
     * @return Entities_Configuration 
     */
    public function getByKey($strKey) {
        $db = new Entities_Configuration();
        $db->ConKey = $strKey;
        $db->get();
        return $db;
    }

}
