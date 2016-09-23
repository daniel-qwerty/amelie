<?PHP

class Users_Controller_Admin extends Admin_Controller_Admin {

    public function init() {
        parent::init();
        Com_Helper_Title::getInstance()->title = "M&oacute;dulo de Usuarios";

        Com_Helper_BreadCrumbs::getInstance()->add("Usuarios", "/Admin/Users");
    }

    public function Index() {
        
    }

    public function Add() {
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
            
            Users_Model_User::getInstance()->doInsert(get('Name'), get('Mail'), get('Login'), get('Password'), get('Status'), get('Type'), $image);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Users');
        }
        $this->assign('Name', "");
        $this->assign('Image', "");
        $this->assign('Mail', "");
        $this->assign('Login', "");
        $this->assign('Password', "");
        $this->assign('Estado', "");
        $this->assign('Type', "");
        $this->assign('Types', Users_Model_Type::getInstance()->getList());
    }

    public function Edit() {
        $this->setView("add");
        
        
            
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
            
            Users_Model_User::getInstance()->doUpdate(get('id'), get('Name'), get('Mail'), get('Login'), get('Password'), get('Status'), get('Type'), $image);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Users');
        }

        $entity = Users_Model_User::getInstance()->get(get('id'));

        $this->assign('Name', $entity->UserName);
        $this->assign('Image', $entity->UserImage);
        $this->assign('Mail', $entity->UserMail);
        $this->assign('Login', $entity->UserLogin);
        $this->assign('Password',$entity->UserPassword);
        $this->assign('Estado', $entity->UserEstado);
        $this->assign('Type', $entity->UserTypId);
        $this->assign('Types', Users_Model_Type::getInstance()->getList());
    }

    public function Delete() {
        Users_Model_User::getInstance()->doDelete(get('id'));
        $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Users');
    }

}

?>