<?php

class SlideShows_Model_SlideShow extends Com_Module_Model {

    /**
     *
     * @return SlideShows_Model_SlideShow 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj, $languages, $image) {

        $db = new Entities_SlideShow();

        $id = $db->getNextId();

        foreach ($languages as $language) {
            $db->SliId = $id;
            $db->SliLanId = $language->LanId;
            $db->SliTitle = $obj->Title;
            $db->SliDescription = $obj->Description;
            $db->SliImage = $image;
            $db->SliLink = $obj->Link;
            $db->SliStatus = $obj->Status;
            $db->action = ACTION_INSERT;
            $db->save();
        }

        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");

        return $id;
    }

    public function doUpdate($intId, Com_Object $obj, $image) {
        $db = new Entities_SlideShow();
        $db->SliId = $intId;
        $db->SliLanId = $obj->Language;
        $db->SliTitle = $obj->Title;
        $db->SliDescription = $obj->Description;
        if ($image != "") {
            $db->SliImage = $image;
        }
        $db->SliLink = $obj->Link;
        $db->SliStatus = $obj->Status;

        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }

    public function doDelete($intId) {
        $db = new Entities_SlideShow();
        $db->SliId = $intId;
        $db->action = ACTION_DELETE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function get($intId, $lanId) {
        $db = new Entities_SlideShow();
        $db->SliId = $intId;
        $db->SliLanId = $lanId;
        $db->get();
        return $db;
    }

    public function getList($lanId) {
        $text = new Entities_SlideShow();
        return $text->getAll($text->getList()->where("SliLanId={$lanId}"));
    }

    public function getListEnable($lanId, $cat) {       
        $text = new Entities_SlideShow();
        return $text->getAll($text->getList()->where("SliLanId={$lanId} and SliStatus=1 and SliLink='{$cat}'"));
    }

}
