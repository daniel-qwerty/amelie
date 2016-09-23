<?php

class Com_Helper_GeoCode extends Com_Object {

    /**
     * @return Com_Helper_GeoCode
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function getData($ip) {
        return json_decode(file_get_contents("http://freegeoip.net/json/" . $ip));
    }

}
