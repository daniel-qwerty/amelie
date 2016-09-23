<?php

class Com_Helper_Url extends Com_Object {

    /**
     *
     * @access public
     * @var String
     */
    public $physicalDirectory;

    /**
     *
     * @access public
     * @var String
     */
    public $urlBase;

    /**
     * @static
     * @access public
     * @return Com_Helper_Url 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    /**
     * 
     * @access public
     */
    public function __construct() {
        $requestUri = get("SCRIPT_NAME");
        $requestUri = str_replace("/App.php", "", $requestUri);
        /**
         * Modificacion 
         */
        $requestUri = str_replace("/index.php", "", $requestUri);
        $requestUri = explode("/", $requestUri);
        $this->urlBase = (get('HTTPS') == "on" ? "https" : "http") . "://" . get("HTTP_HOST");
        foreach ($requestUri as $value) {
            if ($value != "") {
                $this->urlBase.="/" . $value;
            }
        }
        $this->physicalDirectory = get("DOCUMENT_ROOT");
        foreach ($requestUri as $value) {
            if ($value != "") {
                $this->physicalDirectory.="/" . $value;
            }
        }
    }

    /**
     *
     * @access public
     * @return String
     */
    public function getResources() {
        return $this->urlBase . "/Resources";
    }

    /**
     *
     * @access public
     * @return String
     */
    public function getStyle() {
        return $this->urlBase . "/Resources/Style";
    }

    /**
     *
     * @access public
     * @return String
     */
    public function getScript() {
        return $this->urlBase . "/Resources/Script";
    }

    /**
     *
     * @access public
     * @return String
     */
    public function getImage() {
        return $this->urlBase . "/Resources/Image";
    }

    /**
     *
     * @access public
     * @return String
     */
    public function getUploads() {
        return $this->urlBase . "/Resources/Uploads";
    }

    public function getUrl() {
        return $this->urlBase . '/' . get("QUERY_STRING");
    }

    /**
     *
     * @param String $urlBase 
     */
    public function setUrlBase($urlBase) {
        $this->urlBase = $urlBase;
    }

    public function generateUrl($lanCode, $url) {
        return $this->urlBase . '/' . $lanCode . '/' . $url;
    }

}

?>
