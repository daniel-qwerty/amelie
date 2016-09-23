<?php

class Language_Model_Language extends Com_Module_Model {

    /**
     *
     * @return Language_Model_Language 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj) {

        $db = new Entities_Language();
        $db->LanCode = $obj->Code;
        $db->LanName = $obj->Name;
        $db->LanDefault = $obj->Default;
        $db->action = ACTION_INSERT;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");
    }

    public function doUpdate($intId, Com_Object $obj) {
        $db = new Entities_Language();
        $db->LanId = $intId;
        $db->LanCode = $obj->Code;
        $db->LanName = $obj->Name;
        $db->LanDefault = $obj->Default;
        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }

    public function doDelete($intId) {
        $db = new Entities_Language();
        $db->LanId = $intId;
        $db->action = ACTION_DELETE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function get($intId) {
        $db = new Entities_Language();
        $db->LanId = $intId;
        $db->get();
        return $db;
    }

    public function getByCode($code) {
        $db = new Entities_Language();
        $db->LanCode = $code;
        $db->get();
        return $db;
    }

    public function getList() {
        $db = new Entities_Language();
        return $db->getAll($db->getList());
    }

}
