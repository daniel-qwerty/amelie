<?php

class Links_Helper_Link extends Com_Object {

    /**
     *
     * @return Links_Helper_Link 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function get($name) {
        return Links_Model_Links::getInstance()->getByAlias($name);
    }

}
