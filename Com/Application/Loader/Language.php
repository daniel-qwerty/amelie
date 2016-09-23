<?php

class Com_Application_Loader_Language extends Com_Application_Request_Language {

    /**
     *
     * @static
     * @access public
     * @return Com_Application_Loader_Language
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function run() {
        //Change between Page and CMS dependes on Controller View
        if (($this->language == "Admin") || ($this->language == "Service")) {
            $new = new Com_Application_Loader();
            $new->run();
            exit;
        }
        session_start();
        $module = $this->module . "_Information";
        $controller = $this->module . "_Controller_" . $this->controller;
        $view = $this->view;
        $module = new $module();
        $controller = new $controller();
        $module->init();
        $controller->init();
        $controller->setView($view);
        $controller->$view();
        $controller->render();
        $controller->postInit();
        $module->postInit();
    }

}
