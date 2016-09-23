<?php

class Com_Application_Request extends Com_Object {

    /**
     *
     * @access public
     * @var String 
     */
    public $controller = "Admin";

    /**
     *
     * @access public
     * @var String
     */
    public $module = "Admin";

    /**
     *
     * @access public
     * @var String
     */
    public $view = "Index";

    /**
     *
     * @access public 
     * @var String
     */
    public $parameters = array();

    /**
     * @static
     * @access public
     * @return Com_Application_Request
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
        $this->controller = (isset($lstRequest[0]) ? (strlen($lstRequest[0]) > 0 ? ucfirst($lstRequest[0]) : "Index") : "Index");
        set("controller", $this->controller);
        $this->module = (isset($lstRequest[1]) ? (strlen($lstRequest[1]) > 0 ? ucfirst($lstRequest[1]) : "Public") : "Public");
        set("module", $this->module);
        $this->view = (isset($lstRequest[2]) ? (strlen($lstRequest[2]) > 0 ? ucfirst($lstRequest[2]) : "Index") : "Index");
        set("view", $this->view);
        if (count($lstRequest) > 3) {
            $number = count($lstRequest);
            for ($i = 3; $i < ($number - 1); $i = $i + 2) {
                $this->parameters[$lstRequest[$i]] = $lstRequest[$i + 1];
            }
            foreach ($this->parameters as $strIndex => $strValue) {
                set($strIndex, $strValue);
            }
        }
    }

    /**
     *
     * @access public
     * @return Boolean
     */
    public function isPost() {
        return (get('REQUEST_METHOD') === 'POST' ? true : false);
    }

    /**
     *
     * @return Array
     */
    public function getPost() {
        if ($_POST) {
            return $_POST;
        }
        return array();
    }

    /**
     *
     * @access public
     * @return Com_Object 
     */
    public function getPostObject() {
        $objPost = new Com_Object();
        if ($this->isPost()) {
            if (is_array($_POST)) {
                foreach ($_POST as $index => $value) {
                    $objPost->$index = $value;
                }
            }
        }
        return $objPost;
    }

}
