<?php

class Clients_Model_Client extends Com_Module_Model {

    /**
     *
     * @return Clients_Model_Client
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj) {

        $db = new Entities_Client();
        $db->CliName = $obj->Name;
        $db->CliCi = $obj->Ci;
        $db->CliCity = $obj->City;
        $db->CliCupon = $obj->Cupon;
        $db->CliEmail = $obj->Email;
        $db->CliPhone = $obj->Phone;
        $db->CliStatus = $obj->Status;
        $db->action = ACTION_INSERT;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");
    }

    public function doUpdate($intId, Com_Object $obj) {
        $db = new Entities_Client();
        $db->CliId = $intId;
        $db->CliName = $obj->Name;
        $db->CliCi = $obj->Ci;
        $db->CliCity = $obj->City;
        $db->CliCupon = $obj->Cupon;
        $db->CliEmail = $obj->Email;
        $db->CliPhone = $obj->Phone;
        $db->CliStatus = $obj->Status;
        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }

    public function doDelete($intId) {
        $db = new Entities_Client();
        $db->CliId = $intId;
        $db->action = ACTION_DELETE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function get($intId) {
        $db = new Entities_Client();
        $db->CliId = $intId;
        $db->get();
        return $db;
    }

    public function getByName($strName) {
        $db = new Entities_Client();
        $db->CliName = $strName;
        $db->get();
        return $db;
    }
    public function getByEmail($strName) {
        $db = new Entities_Client();
        $db->CliEmail = $strName;
        $db->get();
        return $db;
    }

    public function getList() {
        $contact = new Entities_Client();
        return $contact->getAll($contact->getList());
    }

    public function countAll() {
        $db = new Entities_Client();
        return $db->getAll("select count(*) as number from {$db}");
    }

     public function getByAlias($strName) {
        $db = new Entities_Client();
        $db->CliName = $strName;
        $db->get();
        return $db;
    }

}
