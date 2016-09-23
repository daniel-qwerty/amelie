<?php

class Images_Helper_Image extends Com_Object {

    /**
     *
     * @return Images_Helper_Image 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function get($lan, $alias) {
        return Images_Model_Image::getInstance()->getByAlias($lan->LanId, $alias);
    }

}
