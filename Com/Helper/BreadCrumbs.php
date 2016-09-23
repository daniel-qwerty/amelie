<?php

class Com_Helper_BreadCrumbs extends Com_Object {

    private $lstIcons = array();

    /**
     * @static
     * @access public
     * @return Com_Helper_BreadCrumbs 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function add($label, $href = "", $external = false) {
        $this->lstIcons[] = array(
            'label' => $label
            , 'href' => $href
            , 'external' => $external
        );
    }

    public function render() {
        if (count($this->lstIcons) > 0) {
            ?>

            <ol class="breadcrumb">
                <?PHP
                foreach ($this->lstIcons as $icon) {
                    if (!$icon['external']) {
                        $icon['href'] = Com_Helper_Url::getInstance()->urlBase . $icon['href'];
                    }
                    ?>
                    <li><a href="<?PHP echo $icon['href']; ?>"><?PHP echo $icon['label']; ?></a></li>
                    <?PHP
                }
                ?>
            </ol>
            <?PHP
        }
    }

}
