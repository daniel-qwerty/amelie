<?PHP

class SlideShows_Controller_Admin extends Admin_Controller_Admin {

    public function init() {
        parent::init();
        Com_Helper_Title::getInstance()->title = "M&oacute;dulo SlideShow";
        Com_Helper_BreadCrumbs::getInstance()->add("SlidesShows", "/Admin/SlideShows");
    }

    public function Add() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/SlideShows/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        if ($this->isPost()) {

            $image = "";
            if (Com_File_Handler::getInstance()->setFile(get("Image"))->hasErrors()) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
            } else {
                if (!(Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image/"))) {
                    Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
                } else {
                    $image = Com_File_Handler::getInstance()->getFileName();
                }
            }
         
            $id = SlideShows_Model_SlideShow::getInstance()->doInsert($this->getPostObject(), $languages, $image);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/SlideShows/Edit/id/' . $id);
        }
        $this->assign('Title');
        $this->assign('Description');
        $this->assign('Image');
        $this->assign('Link');
        $this->assign('Status');
        $this->assign("languages", $languages);
        $this->assign("Language", (get('lan') != "" ? get('lan') : $languages[0]->LanId));
    }

    public function Edit() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/SlideShows/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        $language = (get('lan') != "" ? get('lan') : $languages[0]->LanId);

        if ($this->isPost()) {

            $image = "";
            if (Com_File_Handler::getInstance()->setFile(get("Image"))->hasErrors()) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
            } else {
                if (!(Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image/"))) {
                    Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
                } else {
                    $image = Com_File_Handler::getInstance()->getFileName();
                }
            }

            SlideShows_Model_SlideShow::getInstance()->doUpdate(get('id'), $this->getPostObject(), $image);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/SlideShows/Edit/lan/' . $language . '/id/' . get('id'));
        }

        $entity = SlideShows_Model_SlideShow::getInstance()->get(get('id'), $language);

        $this->assign("Id", $entity->SliId);
        $this->assign("Language", $entity->SliLanId);
        $this->assign('Title', $entity->SliTitle);
        $this->assign('Description', $entity->SliDescription);
        $this->assign('Image', $entity->SliImage);
        $this->assign('Link', $entity->SliLink);
        $this->assign('Status', $entity->SliStatus);

        $this->assign("languages", $languages);
    }

    public function Delete() {
        SlideShows_Model_SlideShow::getInstance()->doDelete(get('id'));
        $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/SlideShows');
    }

}

?>