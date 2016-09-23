<?php

class Com_Application_Loader extends Com_Application_Request {

    /**
     *
     * @static
     * @access public
     * @return Com_Application_Loader
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function run() {
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
