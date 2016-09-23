<?php

class Com_Helper_Style extends Com_Object {

    /**
     *
     * @access private
     * @var Array
     */
    private $lstFiles = array();

    /**
     * @static
     * @access public
     * @return Com_Helper_Style
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    /**
     *
     * @access public
     * @param String $fileName 
     */
    public function addFile($fileName) {
        $this->lstFiles[$fileName] = $fileName;
        return $this;
    }

    /**
     *
     * @access public
     * @return Array 
     */
    private function getFiles() {
        $url = Com_Helper_Url::getInstance()->getStyle();
        $result = "";
        foreach ($this->lstFiles as $fileName) {
            $result.='<link rel="StyleSheet" href="' . $url . '/' . $fileName . '" type="text/css">';
        }
        return $result;
    }

    public function __toString() {
        return $this->getFiles();
    }

}
