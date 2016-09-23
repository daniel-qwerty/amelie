<?PHP

class Menu_Controller_Admin extends Admin_Controller_Admin {

    public function init() {
        parent::init();
        Com_Helper_Title::getInstance()->title = "M&oacute;dulo Menu";
        Com_Helper_BreadCrumbs::getInstance()->add("Menu", "/Admin/Menu");
    }

    public function Add() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Menu/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        if ($this->isPost()) {

            $fileName = "";
            if (Com_File_Handler::getInstance()->setFile(get("Image"))->hasErrors()) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
            } else if (Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image/")) {
                $fileName = Com_File_Handler::getInstance()->getFileName();
            }


            $id = Menu_Model_Menu::getInstance()->doInsert($this->getPostObject(), $languages, $fileName);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Menu/Edit/id/' . $id);
        }

        $this->assign('Alias');
        $this->assign('Parent');
        $this->assign('Target');
        $this->assign('Url');
        $this->assign('Status');
        $this->assign('Image');
        $this->assign('Description');
        $this->assign('X', 0);
        $this->assign('Y', 0);
        $this->assign('W', 0);
        $this->assign('H', 0);

        $this->assign('Parents', Menu_Model_Menu::getInstance()->getParents((get('lan') != "" ? get('lan') : $languages[0]->LanId)));
        $this->assign("languages", $languages);
        $this->assign("Language", (get('lan') != "" ? get('lan') : $languages[0]->LanId));
    }

    public function Edit() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Menu/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        $language = (get('lan') != "" ? get('lan') : $languages[0]->LanId);

        if ($this->isPost()) {

            $fileName = "";
            if (Com_File_Handler::getInstance()->setFile(get("Image"))->hasErrors()) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
            } else if (Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image/")) {
                $fileName = Com_File_Handler::getInstance()->getFileName();
            }

            Menu_Model_Menu::getInstance()->doUpdate(get('id'), $this->getPostObject(), $fileName);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Menu/Edit/lan/' . $language . '/id/' . get('id'));
        }

        $entity = Menu_Model_Menu::getInstance()->get(get('id'), $language);

        $this->assign("Id", $entity->MenId);
        $this->assign("Language", $entity->MenLanId);
        $this->assign('Alias', $entity->MenAlias);
        $this->assign('Parent', $entity->MenParentId);
        $this->assign('Target', $entity->MenTarget);
        $this->assign('Url', $entity->MenUrl);
        $this->assign('Status', $entity->MenStatus);
        $this->assign('Image', $entity->MenImage);
        $this->assign('Description', $entity->MenDescription);
        $this->assign('X', $entity->MenX);
        $this->assign('Y', $entity->MenY);
        $this->assign('W', $entity->MenW);
        $this->assign('H', $entity->MenH);

        $this->assign('Parents', Menu_Model_Menu::getInstance()->getParents($entity->MenLanId, $entity->MenId));
        $this->assign("languages", $languages);
    }

    public function Delete() {
        Menu_Model_Menu::getInstance()->doDelete(get('id'));
        $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Menu');
    }

    public function Order() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Menu/Add");
        $languages = Language_Model_Language::getInstance()->getList();

        $language = (get('lan') != "" ? get('lan') : $languages[0]->LanId);

        if ($this->isPost()) {
            Menu_Model_Menu::getInstance()->refreshOrder($language, get('Order'));
        }


        $this->assign('lstModules', Menu_Model_Menu::getInstance()->getList($language));
        $this->assign("Language", $language);
        $this->assign("languages", $languages);
    }

}

?>