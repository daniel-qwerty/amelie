<?PHP

class Contact_Controller_Admin extends Admin_Controller_Admin {

    public function init() {
        parent::init();
        Com_Helper_Title::getInstance()->title = "M&oacute;dulo Contacto";
        Com_Helper_BreadCrumbs::getInstance()->add("Textos", "/Admin/Contact");
    }

    public function Add() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Contact/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        
        if ($this->isPost()) {
            $id = Contact_Model_Contact::getInstance()->doInsert($this->getPostObject(), $languages);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Contact/Edit/id/' . $id);
        }
        $this->assign('Email');
        $this->assign('Name');
        $this->assign('Message');
        $this->assign('Status');
        $this->assign("languages", $languages);
        $this->assign("Language", (get('lan') != "" ? get('lan') : $languages[0]->LanId));
    }

    public function Edit() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Contact/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        $language = (get('lan') != "" ? get('lan') : $languages[0]->LanId);

        if ($this->isPost()) {
            Contact_Model_Contact::getInstance()->doUpdate(get('id'), $this->getPostObject());
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Contact/Edit/lan/' . $language . '/id/' . get('id'));
        }

        $entity = Contact_Model_Contact::getInstance()->get(get('id'), $language);

        $this->assign("Id", $entity->ConId);
        $this->assign("Language", $entity->ConLanId);
        $this->assign('Date', $entity->ConDate);
        $this->assign('Email', $entity->ConEmail);
        $this->assign('Name', $entity->ConName);
        $this->assign('Message', $entity->ConMessage);
        $this->assign('Status', $entity->ConStatus);

        $this->assign("languages", $languages);
    }

    public function Delete() {
        Contact_Model_Contact::getInstance()->doDelete(get('id'));
        $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Contact');
    }

    public function Export() {
        Com_Helper_BreadCrumbs::getInstance()->add("Exportar", "/Admin/Contacts/Export");
        Com_Helper_Style::getInstance()->addFile("report.css");
        $list = Contact_Model_Contact::getInstance()->getList();
        $this->assign("list", $list);
    }

}

?>