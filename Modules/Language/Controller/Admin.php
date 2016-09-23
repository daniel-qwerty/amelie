<?PHP

class Language_Controller_Admin extends Admin_Controller_Admin {

    public function init() {
        parent::init();
        Com_Helper_Title::getInstance()->title = "M&oacute;dulo Idiomas";
        Com_Helper_BreadCrumbs::getInstance()->add("Idiomas", "/Admin/Language");
    }

    public function Add() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Language/Add");
        if ($this->isPost()) {
            Language_Model_Language::getInstance()->doInsert($this->getPostObject());
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Language');
        }

        $this->assign('Code');
        $this->assign('Name');
        $this->assign('Default');
    }

    public function Edit() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Language/Add");
        $this->setView("add");
        if ($this->isPost()) {
            Language_Model_Language::getInstance()->doUpdate(get('id'), $this->getPostObject());
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Language');
        }
        $entity = Language_Model_Language::getInstance()->get(get('id'));
        $this->assign('Code', $entity->LanCode);
        $this->assign('Name', $entity->LanName);
        $this->assign('Default', $entity->LanDefault);
    }

    public function Delete() {
        Language_Model_Language::getInstance()->doDelete(get('id'));
        $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Language');
    }

    public function File() {
        $entity = Language_Model_Language::getInstance()->get(get('id'));
        $fileDir = Com_Helper_Url::getInstance()->physicalDirectory . '/Languages/' . $entity->LanCode . ".language";
        $content = "";
        if ($this->isPost()) {
            //guardamos el archivo
            if (file_put_contents($fileDir, get('File')) !== false) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Archivo Actualizado");
            } else {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_WARNING, "No se ha podido actualizar el archivo de idioma");
            }
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Language/File/id/' . get('id'));
        }
        //leemos el archivo
        if (file_exists($fileDir)) {
            $content = file_get_contents($fileDir);
        }
        $this->assign('Code', $entity->LanCode);
        $this->assign('Name', $entity->LanName);
        $this->assign('File', $content);
        $this->assign('Default', $entity->LanDefault);
    }

}

?>