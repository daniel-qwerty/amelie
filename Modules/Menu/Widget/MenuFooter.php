<?php

class Menu_Widget_MenuFooter extends Com_Object {

    private $lan;
    private $parent = 0;

    /**
     *
     * @static
     * @access public
     * @return Menu_Widget_Menu
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function setParent($id) {
        $this->parent = $id;
        return $this;
    }

    public function setLan($lan) {
        $this->lan = $lan;
        return $this;
    }

    /**
     * @access public
     */
    public function render() {

        $list = Menu_Model_Menu::getInstance()->getMenuList($this->lan->LanId, $this->parent);
        $actualUrl = Com_Helper_Url::getInstance()->urlBase . '/' . get("QUERY_STRING");
        ?>

        
            <?PHP
            foreach ($list as $item) :
                $url = Com_Helper_Url::getInstance()->generateUrl($this->lan->LanCode, $item->MenUrl);
                $active = false;
                if ($actualUrl == $url) {
                    $active = true;
                }
                ?>
                <a href="<?PHP echo $url; ?>"><?PHP echo $item->MenAlias; ?></a> <br>
            
            <?PHP endforeach;            ?>
       

        <?PHP
    }

}
?>
