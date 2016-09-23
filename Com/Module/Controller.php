<?php


class Com_Module_Controller extends Com_Application_Request {

    /**
     *
     * @access protected
     * @var String
     */
    protected $_layout = "login.phtml";

    /**
     *
     * @access protected
     * @var String
     */
    protected $_view = "login.phtml";

    /**
     *
     * @access protected
     * @var Array
     */
    protected $_lstParameters = array();

    /**
     *
     * @access protected
     * @var Boolean
     */
    protected $_renderView = true;

    /**
     *
     * @access protected
     * @var Boolean
     */
    protected $_renderLayout = true;

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
     * @var Boolean
     */
    public $render = true;

    /**
     * @access public
     */
    public function __construct() {
        $this->controller = get("controller");
        $this->module = get("module");
        $this->view = get("view");
    }

    /**
     * @access public
     */
    public function init() {
        
    }

    /**
     *
     * @access public
     * @param String $layoutName 
     */
    public function setLayout($layoutName) {
        $this->_layout = strtolower($layoutName) . ".phtml";
    }

    /**
     *
     * @access public
     * @param String $viewName 
     */
    public function setView($viewName) {
        $this->view = strtolower($viewName) . ".phtml";
    }

    public function setNoRender() {
        $this->render = false;
    }

    /**
     * 
     * @access public
     */
    public function render() {
        if ($this->render) {
            if ($this->_renderLayout) {
                include("Resources/Layouts/{$this->_layout}");
            }
        }
    }

    /**
     * 
     * @access public
     */
    public function getContent() {
        if ($this->_renderView) {
            include("Modules/{$this->module}/View/{$this->view}");
        }
    }

    /**
     *
     * @access public
     * @param String $name
     * @param String $value 
     */
    public function assign($name, $value="") {
        $this->_lstParameters[$name] = $value;
    }

    /**
     *
     * @access public
     * @param String $name
     * @return String/Variant
     */
    public function __get($name) {
        return $this->_lstParameters[$name];
    }

    /**
     *
     * @access public
     * @param String $url 
     */
    public function redirect($url) {
        header("location:{$url}");
        exit;
    }

    /**
     *
     * @access public
     * @param Boolean $flag 
     */
    public function renderLayout($flag=true) {
        $this->_renderLayout = $flag;
    }

    /**
     *
     * @access public
     * @param Boolean $flag
     */
    public function renderView($flag=true) {
        $this->_renderView = $flag;
    }

    /**
     * 
     * @access public
     */
    public function postInit() {
        
    }

}
