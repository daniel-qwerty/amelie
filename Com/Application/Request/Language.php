<?php

class Com_Application_Request_Language extends Com_Application_Request {

    /**
     *
     * @access public
     * @var String 
     */
    public $language = "En";

    /**
     * @static
     * @access public
     * @return Com_Application_Request_Language
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    /**
     * @access public
     */
    public function __construct() {
        $request = get("QUERY_STRING");
        //$strRequest=  substr(get("PATH_INFO"), 1);
        $request = Com_Application_Route::getInstance()->applyRoutes($request);
        $lstRequest = explode("/", $request);
        $this->language = (isset($lstRequest[0]) ? (strlen($lstRequest[0]) > 0 ? ucfirst($lstRequest[0]) : "Es") : "Es");
        set("language", $this->language);
        $this->controller = (isset($lstRequest[1]) ? (strlen($lstRequest[1]) > 0 ? ucfirst($lstRequest[1]) : "Index") : "Index");
        set("controller", $this->controller);
        $this->module = (isset($lstRequest[2]) ? (strlen($lstRequest[2]) > 0 ? ucfirst($lstRequest[2]) : "Public") : "Public");
        set("module", $this->module);
        $this->view = (isset($lstRequest[3]) ? (strlen($lstRequest[3]) > 0 ? ucfirst($lstRequest[3]) : "Index") : "Index");
        set("view", $this->view);
        if (count($lstRequest) > 3) {
            $number = count($lstRequest);
            for ($i = 4; $i < ($number - 1); $i = $i + 2) {
                $this->parameters[$lstRequest[$i]] = $lstRequest[$i + 1];
            }
            foreach ($this->parameters as $strIndex => $strValue) {
                set($strIndex, $strValue);
            }
        }
    }

}
