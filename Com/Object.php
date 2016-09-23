<?php

class Com_Object {

    protected static $_instances = array();

    protected static function &_getInstance($name) {
        if (!array_key_exists($name, self::$_instances)) {
            self::$_instances[$name] = new $name();
        }
        return self::$_instances[$name];
    }

    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function __get($name) {
        return $this->$name;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }
}
