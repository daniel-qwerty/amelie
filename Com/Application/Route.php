<?php

class Com_Application_Route extends Com_Object {

    public $pattern;
    public $result;

    /**
     *
     * @static
     * @access public
     * @return Com_Application_Route
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function test($string) {
        if (preg_match($this->pattern, $string)) {
            $string = explode("/", $string);
            foreach ($string as $index => $value) {
                $this->result = str_replace("_{$index}_", $value, $this->result);
            }
            return true;
        }
        return false;
    }

    public function applyRoutes($string) {
        $lstRoutes = readDirectory(Com_Helper_Url::getInstance()->physicalDirectory . "/Routes");
        foreach ($lstRoutes as $value) {
            if (strpos($value, ".php") > 0) {
                $value = 'Routes_' . str_replace(".php", "", $value);
                $obj = new $value();
                if ($obj->test($string)) {
                    return $obj->result;
                }
            }
        }
        return $string;
    }

}
