<?php

class Pages_Widget_SocialIcons extends Com_Object {



    /**
     *
     * @static
     * @access public
     * @return Pages_Widget_SocialIcons
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }



    public function render() {
        ?>
        <ul class="unstyled inline social-icons social-simple">
            <li> <a target="_blank" href="<?PHP echo Links_Helper_Link::getInstance()->get('LinkFacebook')->LinUrl; ?>"><img src="<?PHP echo Com_Helper_Url::getInstance()->getImage(); ?>/Public/hotel/fb.png"></a> </li>
            <li> <a target="_blank" href="<?PHP echo Links_Helper_Link::getInstance()->get('LinkInstagram')->LinUrl; ?>"><img src="<?PHP echo Com_Helper_Url::getInstance()->getImage(); ?>/Public/hotel/instagram.png"></a> </li>
            <li> <a target="_blank" href="<?PHP echo Links_Helper_Link::getInstance()->get('LinkTripadvisor')->LinUrl; ?>"><img src="<?PHP echo Com_Helper_Url::getInstance()->getImage(); ?>/Public/hotel/tripadvisor.png"></a> </li>
        </ul>
        <?PHP
    }

}
