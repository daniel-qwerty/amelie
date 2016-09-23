<?php

class Links_Model_Links extends Com_Module_Model {

    /**
     *
     * @return Links_Model_Links 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj) {

        $db = new Entities_Links();
        $db->LinName = $obj->Name;
        $db->LinUrl = $obj->Url;
        $db->LinStatus = $obj->Status;
        $db->action = ACTION_INSERT;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");
    }

    public function doInsertFromWs(Com_Object $obj) {

        $db = new Entities_Links();
        $db->LinName = $obj->Name;
        $db->LinUrl = $obj->Url;
        $db->LinStatus = $obj->Status;
        $db->action = ACTION_INSERT;
        $db->save();
    }

    public function doUpdate($intId, Com_Object $obj) {
        $db = new Entities_Links();
        $db->LinId = $intId;
        $db->LinName = $obj->Name;
        $db->LinUrl = $obj->Url;
        $db->LinStatus = $obj->Status;
        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }

    public function doDelete($intId) {
        $db = new Entities_Links();
        $db->LinId = $intId;
        $db->action = ACTION_DELETE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function get($intId) {
        $db = new Entities_Links();
        $db->LinId = $intId;
        $db->get();
        return $db;
    }

    public function getByName($strName) {
        $db = new Entities_Links();
        $db->LinName = $strName;
        $db->get();
        return $db;
    }

    public function getList() {
        $contact = new Entities_Links();
        return $contact->getAll($contact->getList());
    }
     public function getByAlias($strName) {
        $db = new Entities_Links();
        $db->LinName = $strName;
        $db->get();
        return $db;
    }

}
