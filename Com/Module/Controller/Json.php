<?php


class Com_Module_Controller_Json extends Com_Module_Controller{
    
    public function init() {
        $this->setNoRender();
        header("content-type:text/json");
    }
    
}