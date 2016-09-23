<?php

class Menu_Widget_Menu extends Com_Object {

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
            $sublist = Menu_Model_Menu::getInstance()->getMenuList($this->lan->LanId, $item->MenId);
            $url = Com_Helper_Url::getInstance()->generateUrl($this->lan->LanCode, $item->MenUrl);
            $active = false;
            if ($actualUrl == $url) {
                $active = true;
            }

            if (count($sublist) == 0):
                ?>
                <li class="menu-item <?= ($active) ? 'active' : '' ?> "> 
                    <a href="<?= Com_Helper_Url::getInstance()->urlBase . '/' . $this->lan->LanCode . '/' . $item->MenUrl; ?>"><?PHP echo $item->MenAlias; ?></a> 
                </li>
                <?PHP
            else:
                ?>
                <li class="menu-item  dropdown"> 
                    <a class="dropdown-toggle" data-toggle="dropdown" href="/#"><?PHP echo $item->MenAlias; ?></a>
                    <ul class="dropdown-menu dropdown-menu-left">
                        <?php
                        foreach ($sublist as $subitem):
                            $sw = substr($subitem->MenUrl, strlen($subitem->MenUrl) - 1, strlen($subitem->MenUrl));
                            ?>

                            <li class="menu-item"> 
                                <a href="<?= Com_Helper_Url::getInstance()->urlBase . '/' . $this->lan->LanCode . '/' . $subitem->MenUrl; ?>"><?PHP echo $subitem->MenAlias; ?></a>  
                            </li>

                        <?php endforeach;
                        ?>

                    </ul>
                </li>


            <?php
            endif;
        endforeach
        ?>

        <?PHP
    }
}
?>
