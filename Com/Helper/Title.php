<?php

class Com_Helper_Title extends Com_Object {

    public $title = "";

    /**
     * @static
     * @access public
     * @return Com_Helper_Title 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function render() {
        ?>
        <div class="page-title">
            <h3><?= $this->title; ?></h3>
            <div class="page-breadcrumb">
                <?php Com_Helper_BreadCrumbs::getInstance()->render(); ?>
            </div>
        </div>
        <?PHP
    }

}
