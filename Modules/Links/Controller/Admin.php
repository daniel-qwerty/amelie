<?PHP

class Links_Controller_Admin extends Admin_Controller_Admin {

    public function init() {
        parent::init();
        Com_Helper_Title::getInstance()->title = "M&oacute;dulo Links";
        Com_Helper_BreadCrumbs::getInstance()->add("Links", "/Admin/Links");
    }

    public function Add() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Links/Add");
        if ($this->isPost()) {
            Links_Model_Links::getInstance()->doInsert($this->getPostObject());
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Links');
        }

        $this->assign('Name');
        $this->assign('Url');
        $this->assign('Status');
    }

    public function Edit() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Links/Add");
        $this->setView("add");
        if ($this->isPost()) {
            Links_Model_Links::getInstance()->doUpdate(get('id'), $this->getPostObject());
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Links');
        }
        $entity = Links_Model_Links::getInstance()->get(get('id'));
        $this->assign('Name', $entity->LinName);
        $this->assign('Url', $entity->LinUrl);
        $this->assign('Status', $entity->LinStatus);
    }

    public function Delete() {
        Links_Model_Links::getInstance()->doDelete(get('id'));
        $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Links');
    }

    

}

?>