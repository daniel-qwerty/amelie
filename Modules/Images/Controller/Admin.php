<?PHP

class Images_Controller_Admin extends Admin_Controller_Admin {

    public function init() {
        parent::init();
        Com_Helper_Title::getInstance()->title = "M&oacute;dulo Imagenes";
        Com_Helper_BreadCrumbs::getInstance()->add("Imagenes", "/Admin/Images");
    }

    public function Add() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Images/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        if ($this->isPost()) {
            
            $imageFile = "";
            if (Com_File_Handler::getInstance()->setFile(get("File"))->hasErrors()) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
            } else if (Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image/")) {
                $imageFile = Com_File_Handler::getInstance()->getFileName();
            }
            
            $id = Images_Model_Image::getInstance()->doInsert($this->getPostObject(), $languages, $imageFile);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Images/Edit/id/' . $id);
        }
        $this->assign('Alias');
        $this->assign('Description');
        $this->assign('Status');
        $this->assign('File');
        $this->assign('Url');
        $this->assign("languages", $languages);
        $this->assign("Language", (get('lan') != "" ? get('lan') : $languages[0]->LanId));
    }

    public function Edit() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Images/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        $language = (get('lan') != "" ? get('lan') : $languages[0]->LanId);
        
        if ($this->isPost()) {
            
            $imageFile = "";
            if (Com_File_Handler::getInstance()->setFile(get("File"))->hasErrors()) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
            } else if (Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image/")) {
                $imageFile = Com_File_Handler::getInstance()->getFileName();
            }
            
            Images_Model_Image::getInstance()->doUpdate(get('id'), $this->getPostObject(), $imageFile);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Images/Edit/lan/' . $language . '/id/' . get('id'));
        }

        $entity = Images_Model_Image::getInstance()->get(get('id'), $language);

        $this->assign("Id", $entity->ImgId);
        $this->assign("Language", $entity->ImgLanId);
        $this->assign('Alias', $entity->ImgAlias);
        $this->assign('Description', $entity->ImgDescription);
        $this->assign('Status', $entity->ImgStatus);
        $this->assign('File', $entity->ImgFile);
        $this->assign('Url', $entity->ImgUrl);

        $this->assign("languages", $languages);
    }

    public function Delete() {
        Images_Model_Image::getInstance()->doDelete(get('id'));
        $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Images');
    }

}

?>