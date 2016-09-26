<?PHP

class Clients_Controller_Admin extends Admin_Controller_Admin {

    public function init() {
        parent::init();
        Com_Helper_Title::getInstance()->title = "M&oacute;dulo CLientes";
        Com_Helper_BreadCrumbs::getInstance()->add("Clientes", "/Admin/Clients");
    }

    public function Add() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Clients/Add");
        if ($this->isPost()) {
            Clients_Model_Client::getInstance()->doInsert($this->getPostObject());
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Clients');
        }

        $this->assign('Name');
        $this->assign('Ci');
        $this->assign('City');
        $this->assign('Phone');
        $this->assign('Email');
        $this->assign('Cupon');
        $this->assign('Status');
    }

    public function Edit() {
        //Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Clients/Add");
        //$this->setView("add");
        //if ($this->isPost()) {
            Clients_Model_Client::getInstance()->doUpdate(get('id'), '1');
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Clients');
        //}
        //$entity = Clients_Model_Client::getInstance()->get(get('id'));
        //$this->assign('Name', $entity->CliName);
        //$this->assign('Ci', $entity->CliCi);
        //$this->assign('City', $entity->CliCity);
        //$this->assign('Phone', $entity->CliPhone);
        //$this->assign('Email', $entity->CliEmail);
        //$this->assign('Cupon', $entity->CliCupon);
        //$this->assign('Status', '1');
    }

    public function Delete() {
        Clients_Model_Client::getInstance()->doDelete(get('id'));
        $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Clients');
    }

    

}

?>