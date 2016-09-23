<?php

class Statistics_Widget_Counter extends Com_Object {

    /**
     *
     * @return Statistics_Widget_Counter 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function render() {
        $counter = Statistics_Model_Visit::getInstance()->countUnique();
        return $counter[0]->cantidad;
    }

}
