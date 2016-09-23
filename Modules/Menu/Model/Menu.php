<?php

class Menu_Model_Menu extends Com_Module_Model {

    /**
     *
     * @return Menu_Model_Menu 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj, $languages, $file) {

        $db = new Entities_Menu();

        $id = $db->getNextId();

        foreach ($languages as $language) {
            $db->MenId = $id;
            $db->MenLanId = $language->LanId;
            $db->MenParentId = $obj->Parent;
            $db->MenAlias = $obj->Alias;
            $db->MenUrl = $obj->Url;
            $db->MenTarget = $obj->Target;
            $db->MenOrder = $obj->Order;
            $db->MenDescription = $obj->Description;
            $db->MenStatus = $obj->Status;
            $db->MenImage = $file;
            $db->MenX = $obj->X;
            $db->MenY = $obj->Y;
            $db->MenW = $obj->W;
            $db->MenH = $obj->H;
            $db->action = ACTION_INSERT;
            $db->save();
        }

        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");

        return $id;
    }

    public function doUpdate($intId, Com_Object $obj, $file) {
        $db = new Entities_Menu();
        $db->MenId = $intId;
        $db->MenLanId = $obj->Language;
        $db->MenParentId = $obj->Parent;
        $db->MenAlias = $obj->Alias;
        $db->MenUrl = $obj->Url;
        $db->MenTarget = $obj->Target;
        $db->MenOrder = $obj->Order;
        $db->MenDescription = $obj->Description;
        $db->MenStatus = $obj->Status;
        $db->MenImage = $file;
        $db->MenX = $obj->X;
        $db->MenY = $obj->Y;
        $db->MenW = $obj->W;
        $db->MenH = $obj->H;
        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }

    public function doDelete($intId) {
        $db = new Entities_Menu();
        $db->MenId = $intId;
        $db->action = ACTION_DELETE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function refreshOrder($lanId, $lstModuleCodes) {
        foreach ($lstModuleCodes as $intIndex => $intValue) {
            $db = new Entities_Menu();
            $db->MenId = $intValue;
            $db->MenLanId = $lanId;
            $db->MenOrder = $intIndex;
            $db->action = ACTION_UPDATE;
            $db->save();
        }
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Items Ordenados!");
    }

    public function getParents($lanId, $intId = 0) {
        $db = new Entities_Menu();
        return $db->getAll($db->getList()->where("{$db}.MenLanId={$lanId}")->andWhere("{$db}.MenId!={$intId}")->orderBy("MenOrder"));
    }

    public function get($intId, $lanId) {
        $db = new Entities_Menu();
        $db->MenId = $intId;
        $db->MenLanId = $lanId;
        $db->get();
        return $db;
    }

    public function getByUrl($url, $lanId) {
        $db = new Entities_Menu();
        $db->MenUrl = $url;
        $db->MenLanId = $lanId;
        $db->get();
        return $db;
    }

    public function getList($lanId) {
        $db = new Entities_Menu();
        return $db->getAll($db->getList()->where("MenLanId={$lanId}")->orderBy("MenOrder"));
    }

    public function getMenuList($lanId, $parentId = 0) {
        $db = new Entities_Menu();
        return $db->getAll($db->getMenuList()->andWhere("{$db}.MenLanId={$lanId}")->andWhere("MenParentId={$parentId}")->orderBy("MenOrder"));
    }
    
    public function getMenuListFooter($lanId, $parentId = 14) {
        $db = new Entities_Menu();
        return $db->getAll($db->getMenuList()->andWhere("{$db}.MenLanId={$lanId}")->andWhere("MenParentId={$parentId}")->orderBy("MenOrder"));
    }

    public function getParentList($lanId, $parentId = 0) {
        $blocked = array(1, 2, 14);
        $list = array();
        while ($parentId > 0) {
            $parent = $this->get($parentId, $lanId);
            if (!(in_array($parent->MenId, $blocked))) {
                $list[] = $parent;
            }
            $parentId = $parent->MenParentId;
        }
        $list = array_reverse($list);
        return $list;
    }

}
