<?php

class Contact_Model_Contact extends Com_Module_Model {

    /**
     *
     * @return Contact_Model_Contact 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj, $language) {

        $db = new Entities_Contact();

        $id = $db->getNextId();
        $db->ConId = $id;
        $db->ConLanId = $obj->Language;
        $db->ConDate = date("Y-m-d H:i:s");
        $db->ConName = $obj->Name;
        $db->ConEmail = $obj->Email;
        $db->ConMessage = $obj->Message;
        $db->ConStatus = $obj->Status;
        $db->action = ACTION_INSERT;
        $db->save();

        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");

        return $id;
    }

    public function doUpdate($intId, Com_Object $obj) {
        $db = new Entities_Contact();
        $db->ConId = $intId;
        $db->ConLanId = $obj->Language;
        $db->ConName = $obj->Name;
        $db->ConEmail = $obj->Email;
        $db->ConMessage = $obj->Message;
        $db->ConStatus = $obj->Status;
        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }

    public function doDelete($intId) {
        $db = new Entities_Contact();
        $db->ConId = $intId;
        $db->action = ACTION_DELETE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function get($intId, $lanId) {
        $db = new Entities_Contact();
        $db->ConId = $intId;
        $db->ConLanId = $lanId;
        $db->get();
        return $db;
    }

    public function getList() {
        $db = new Entities_Contact();
        return $db->getAll($db->getListWithLanguages());
    }

}
