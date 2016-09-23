<?php


class Com_Helper_Script extends Com_Object {

    /**
     *
     * @access private
     * @var Array
     */
    private $lstFiles = array();

    /**
     * @static
     * @access public
     * @return Com_Helper_Script
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
        $url = Com_Helper_Url::getInstance()->getScript();
        $result = "";
        foreach ($this->lstFiles as $file) {
            $result.='<script type="text/javascript" language="Javascript" src="' . $url . '/' . $file . '"></script>

            ';
        }
        return $result;
    }
    
    public function __toString() {
        return $this->getFiles();
    }

}