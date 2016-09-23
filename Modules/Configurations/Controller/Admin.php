<?php


class Configurations_Controller_Admin extends Admin_Controller_Admin{
    
    public function Index(){
        
        Com_Helper_Title::getInstance()->title="M&oacute;dulo de Configuraci&oacute;n";
        
        Com_Helper_BreadCrumbs::getInstance()->add("Configuraciones", "/Admin/Configurations");
        
        if($this->isPost()){
            Configurations_Model_Configuration::getInstance()->doUpdate($this->getPost());
        }
        $this->assign('Configurations', Configurations_Model_Configuration::getInstance()->getList());
        
    }
}