<?PHP

class Pages_Controller_Admin extends Admin_Controller_Admin {

    public function init() {
        parent::init();
        Com_Helper_Title::getInstance()->title = "M&oacute;dulo P&aacute;ginas";
        Com_Helper_BreadCrumbs::getInstance()->add("P&aacute;ginas", "/Admin/Pages");
    }

    public function Add() {

        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Pages/Add");

        $languages = Language_Model_Language::getInstance()->getList();
        if ($this->isPost()) {
            $fileName = "";
            if (Com_File_Handler::getInstance()->setFile(get("Image"))->hasErrors()) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
            } else {
                if (!(Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image/"))) {
                    Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
                } else {
                    $fileName = Com_File_Handler::getInstance()->getFileName();
                }
            }
            $id = Pages_Model_Pages::getInstance()->doInsert($this->getPostObject(), $languages, $fileName);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Pages/Edit/id/' . $id);
        }

        $this->assign('Name');
        $this->assign('MetaTags');
        $this->assign('Description');
        $this->assign('Content');
        $this->assign('Aditional');
        $this->assign('Image');
        $this->assign('Home');
        $this->assign('Layout');
        $this->assign('Status');
        $this->assign("languages", $languages);
        $this->assign("Language", (get('lan') != "" ? get('lan') : $languages[0]->LanId));
    }

    public function Edit() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Pages/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        $language = (get('lan') != "" ? get('lan') : $languages[0]->LanId);

        if ($this->isPost()) {
            $fileName = "";
            if (Com_File_Handler::getInstance()->setFile(get("Image"))->hasErrors()) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
            } else {
                if (!(Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image/"))) {
                    Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
                } else {
                    $fileName = Com_File_Handler::getInstance()->getFileName();
                }
            }
            Pages_Model_Pages::getInstance()->doUpdate(get('id'), $this->getPostObject(), $fileName);
            //$this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Pages/Edit/lan/' . $language . '/id/' . get('id'));
        }

        $entity = Pages_Model_Pages::getInstance()->get(get('id'), $language);

        $this->assign("Id", $entity->PagId);
        $this->assign("Language", $entity->PagLanId);

        $this->assign('Name', $entity->PagName);
        $this->assign('MetaTags', $entity->PagMetaTags);
        $this->assign('Description', $entity->PagDescription);
        $this->assign('Content', $entity->PagContent);
        $this->assign('Aditional', $entity->PagAditional);
        $this->assign('Image', $entity->PagImage);
        $this->assign('Home', $entity->PagHome);
        $this->assign('Layout', $entity->PagLayout);
        $this->assign('Status', $entity->PagStatus);

        $this->assign("languages", $languages);
    }

    public function Delete() {
        Pages_Model_Pages::getInstance()->doDelete(get('id'));
        $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Pages');
    }

}

?>