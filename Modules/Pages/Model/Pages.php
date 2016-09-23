<?php

class Pages_Model_Pages extends Com_Module_Model {

    /**
     *
     * @return Pages_Model_Pages 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj, $languages, $fileName) {

        $db = new Entities_Page();

        $id = $db->getNextId();

        foreach ($languages as $language) {
            $db->PagId = $id;
            $db->PagLanId = $language->LanId;
            $db->PagName = $obj->Name;
            $db->PagUrl = generateUrl($obj->Name);
            $db->PagMetaTags = $obj->MetaTags;
            $db->PagDescription = $obj->Description;
            $db->PagContent = $obj->Content;
            $db->PagAditional = $obj->Aditional;
            $db->PagHome = $obj->Home;
            $db->PagLayout = $obj->Layout;
            $db->PagImage = $fileName;
            $db->PagStatus = $obj->Status;
            $db->action = ACTION_INSERT;
            $db->save();
        }

        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");

        return $id;
    }

    public function doUpdate($intId, Com_Object $obj, $fileName) {
        $db = new Entities_Page();
        $db->PagId = $intId;
        $db->PagLanId = $obj->Language;
        $db->PagName = $obj->Name;
        $db->PagUrl = generateUrl($obj->Name);
        $db->PagMetaTags = $obj->MetaTags;
        $db->PagDescription = $obj->Description;
        $db->PagContent = $obj->Content;
        $db->PagAditional = $obj->Aditional;
        $db->PagHome = $obj->Home;
        $db->PagLayout = $obj->Layout;
        if ($fileName != "") {
            $db->PagImage = $fileName;
        }
        $db->PagStatus = $obj->Status;
        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }

    public function doDelete($intId) {
        $db = new Entities_Page();
        $db->PagId = $intId;
        $db->action = ACTION_DELETE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function get($intId, $lanId) {
        $db = new Entities_Page();
        $db->PagId = $intId;
        $db->PagLanId = $lanId;
        $db->get();
        return $db;
    }

    public function getForModal($lanId) {
        $db = new Entities_Page();
        $db->PagLayout = "window";
        $db->PagStatus = 1;
        $db->PagLanId = $lanId;
        $db->get();
        return $db;
    }

    public function getByUrl($url, $lanId) {
        $db = new Entities_Page();
        $db->PagUrl = $url;
        $db->PagLanId = $lanId;
        $db->get();
        return $db;
    }

    public function getList() {
        $text = new Entities_Pages();
        return $text->getAll($text->getList());
    }

    public function getByHome($lanId) {
        $db = new Entities_Page();
        $db->PagHome = 1;
        $db->PagLanId = $lanId;
        $db->get();
        return $db;
    }

}
