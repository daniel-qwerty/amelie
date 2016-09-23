<?php

class Menu_Widget_Responsive extends Com_Object {

    private $lan;
    private $parents = array();

    /**
     *
     * @static
     * @access public
     * @return Menu_Widget_Responsive 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function setParent($id) {
        $this->parents[] = $id;
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
        $list = array();

        foreach ($this->parents as $parent) {
            $list = array_merge($list, Menu_Model_Menu::getInstance()->getMenuList($this->lan->LanId, $parent));
        }

        $actualUrl = Com_Helper_Url::getInstance()->urlBase . '/' . get("QUERY_STRING");
        ?>
        <ul>
            <?PHP
            foreach ($list as $item) {
                $url = Com_Helper_Url::getInstance()->generateUrl($this->lan->LanCode, $item->MenUrl);
                $active = false;
                if ($actualUrl == $url) {
                    $active = true;
                }
                ?>
                <li sons="<?PHP echo $item->MenId; ?>">
                    <a href="<?PHP echo $url; ?>" class="<?PHP echo ($active ? "selected" : ""); ?>"><?PHP echo $item->MenAlias; ?></a>   
                    <ul class="sublist">
                        <?PHP
                        $sons = Menu_Model_Menu::getInstance()->getMenuList($this->lan->LanId, $item->MenId);
                        foreach ($sons as $son) {
                            $url = Com_Helper_Url::getInstance()->generateUrl($this->lan->LanCode, $son->MenUrl);
                            $active = false;
                            if ($actualUrl == $url) {
                                $active = true;
                            }
                            if ($son->MenTarget == "_blank") {
                                $url = $son->MenUrl;
                            }
                            ?>
                            <li parent="<?PHP echo $item->MenId; ?>">
                                <a href="<?PHP echo $url; ?>" class="<?PHP echo ($active ? "selected" : ""); ?>"><?PHP echo $son->MenAlias; ?></a>
                            </li>
                            <?PHP
                        }
                        ?>
                    </ul>
                </li>
                <?PHP
            }
            ?>
        </ul>
        <?PHP
    }

}
?>