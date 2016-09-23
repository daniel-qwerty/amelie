<?php


class Public_Controller_Admin extends Com_Module_Controller{
    
    public function init(){
        $this->redirect(Com_Helper_Url::getInstance()->urlBase.'/Admin/Admin');
    }
}