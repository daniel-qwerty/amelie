<?php

class Com_Wizard_Form_Control_HSelect extends Com_Wizard_Form_Control {

    private $lstItems = array();

    public function addItem($value, $label, $parent = 0) {
        $this->lstItems[] = array(
            'parent' => $parent
            , 'value' => $value
            , 'label' => $label
            , 'checked' => false
        );
    }

    private function hasChildren($id) {
        foreach ($this->lstItems as $item) {
            if ($item['parent'] == $id) {
                return true;
            }
        }
        return false;
    }

    private function renderNodes($parent = 0, $level = 0) {
        foreach ($this->lstItems as $objItem) {
            if ($objItem['parent'] == $parent) {
                if ($objItem['value'] == $this->default) {
                    $objItem['checked'] = 'true';
                }
                ?>
                <div class="node" rel="<?PHP echo $level; ?>">
                    <div class="properties">
                        <div class="ratio">
                            <input name="<?PHP echo $this->name; ?>" value="<?PHP echo $objItem['value']; ?>" type="radio" <?PHP echo ($objItem['checked'] ? 'checked="true"' : ""); ?>/>
                        </div>
                        <div class="alias">
                            <?PHP echo $objItem['label']; ?>
                        </div>
                    </div>
                    <?PHP
                    if ($this->hasChildren($objItem['value'])) {
                        ?>
                        <div class="child">
                            <?PHP
                            $this->renderNodes($objItem['value'], ($level + 1));
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

    public function renderControl() {
        ?>
        <div class="tree">
            <?PHP
            $this->renderNodes();
            ?>
        </div>
        <?PHP
    }

}
