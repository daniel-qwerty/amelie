<?php

class Com_Wizard_Form_Control_Tree extends Com_Wizard_Form_Control {

    /**
     *
     * @access public
     * @var Variant
     */
    public $default = array();

    /**
     *
     * @access public
     * @var Boolean
     */
    public $expand = false;

    /**
     *
     * @access public
     * @var Array
     */
    public $lstItems = array();

    /**
     *
     * @access public
     * @param Variant $id
     * @param Variant $value
     * @param String $text
     * @param Variant $parent
     * @param Boolean $checked 
     */
    public function addItem($id, $value, $text, $parent = 0, $checked = false, $readOnly = false, $icon = "folder.png") {
        $this->lstItems[] = array('id' => $id, 'parent' => $parent, 'value' => $value, 'text' => $text, 'checked' => $checked, 'readOnly' => $readOnly, 'icon' => $icon);
    }

    /**
     *
     * @access private
     * @param Integer $id
     * @return Boolean 
     */
    private function hasChildren($id) {
        foreach ($this->lstItems as $item) {
            if ($item['parent'] == $id) {
                return true;
            }
        }
        return false;
    }

    /**
     *
     * @access public
     * @param type $parent
     * @param type $level 
     */
    private function renderNodes($parent = "M0", $level = 0) {
        foreach ($this->lstItems as $objItem) {
            if ($objItem['parent'] == $parent) {
                if (in_array($objItem['value'], $this->default)) {
                    $objItem['checked'] = 'true';
                }
                ?>
                <div class="node" rel="<?PHP echo $level; ?>">
                    <div class="properties">
                        <div class="control">
                            <input name="<?PHP echo $this->name; ?>[]" value="<?PHP echo $objItem['value']; ?>" type="checkbox" <?PHP echo ($objItem['checked'] ? 'checked="true"' : ""); ?> class="<?PHP echo ($objItem['readOnly'] ? 'readOnly' : ''); ?>">
                        </div>
                        <div class="label">
                            <img src="<?PHP echo Com_Helper_Url::getInstance()->getImage() . "/Icon/" . $objItem['icon']; ?>">
                            <?PHP echo $objItem['text']; ?>
                        </div>
                    </div>
                    <?PHP
                    if ($this->hasChildren($objItem['id'])) {
                        ?>
                        <div class="child">
                            <?PHP
                            $this->renderNodes($objItem['id'], ($level + 1));
                            ?>
                        </div>
                        <?PHP
                    }
                    ?>
                </div>
                <?PHP
            }
        }
    }

    /**
     * @access public
     */
    public function renderControl() {
        ?>
        <div class="tree">
            <?PHP
            $this->renderNodes();
            ?>
        </div>
        <?PHP
        $this->renderScript();
    }

    /**
     * @access public
     */
    public function renderScript() {
        ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.tree').permisionsTree({expand:<?PHP echo $this->expand ? 'true' : 'false'; ?>});
            });
        </script>
        <?PHP
    }

}
