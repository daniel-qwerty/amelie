<?php

class Images_Model_Image extends Com_Module_Model {

    /**
     *
     * @return Images_Model_Image 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj, $languages, $file) {

        $db = new Entities_Images();

        $id = $db->getNextId();

        foreach ($languages as $language) {
            $db->ImgId = $id;
            $db->ImgLanId = $language->LanId;
            $db->ImgAlias = $obj->Alias;
            $db->ImgDescription = $obj->Description;
            $db->ImgStatus = $obj->Status;
            $db->ImgUrl = $obj->Url;
            $db->ImgFile = $file;
            $db->action = ACTION_INSERT;
            $db->save();
        }

        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");

        return $id;
    }

    public function doUpdate($intId, Com_Object $obj, $file) {
        $db = new Entities_Images();
        $db->ImgId = $intId;
        $db->ImgLanId = $obj->Language;
        $db->ImgAlias = $obj->Alias;
        $db->ImgDescription = $obj->Description;
        $db->ImgStatus = $obj->Status;
        $db->ImgUrl = $obj->Url;
        if ($file != "") {
            $db->ImgFile= $file;
        }
        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }

    public function doDelete($intId) {
        $db = new Entities_Images();
        $db->ImgId = $intId;
        $db->action = ACTION_DELETE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function get($intId, $lanId) {
        $db = new Entities_Images();
        $db->ImgId = $intId;
        $db->ImgLanId = $lanId;
        $db->get();
        return $db;
    }

    public function getByAlias($lanId, $strAlias) {
        $db = new Entities_Images();
        $db->ImgLanId = $lanId;
        $db->ImgAlias = $strAlias;
        $db->get();
        return $db;
    }

    public function getList() {
        $text = new Entities_Images();
        return $text->getAll($text->getList());
    }

}
