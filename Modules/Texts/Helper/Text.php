<?php

class Texts_Helper_Text extends Com_Object {

    /**
     *
     * @return Texts_Helper_Text 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function get($lan, $alias) {
        return Texts_Model_Text::getInstance()->getByAlias($lan->LanId, $alias);
    }

}
