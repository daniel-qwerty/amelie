<?php

class Pages_Widget_Footer extends Com_Object {



    /**
     *
     * @static
     * @access public
     * @return Pages_Widget_Footer
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }



    public function render() {
        ?>
        <footer>
            <div class="container text-center">
                <p><a target="_blank" href="http://qwerty.com.bo/"><img height="40" src="<?= Com_Helper_Url::getInstance()->getImage(); ?>/Public/logo-qwerty.png" alt=""/></a></p>
                <p>Copyright &copy; QWERTY 2016</p>
            </div>
        </footer>
        <?PHP
    }

}
