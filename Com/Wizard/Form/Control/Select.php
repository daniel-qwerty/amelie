<?php

class Com_Wizard_Form_Control_Select extends Com_Wizard_Form_Control {

    /**
     *
     * @access private
     * @var Array
     */
    private $lstItems = array();

    /**
     * @access public
     */
    public function renderControl() {
        ?>
        <select name="<?PHP echo $this->name; ?>" id="<?PHP echo $this->name; ?>" <?PHP echo $this->getParameters(); ?> class="form-control">
            <?PHP
            foreach ($this->lstItems as $lstItem) {
                ?>
                <option value="<?PHP echo $lstItem['value']; ?>" <?PHP echo ($lstItem['value'] == $this->default ? 'selected' : ''); ?>><?PHP echo $lstItem['label']; ?></option>
                <?PHP
            }
            ?>
        </select>
        <?PHP
    }

    /**
     *
     * @access public
     * @param Variant $value
     * @param String $label 
     */
    public function addItem($value, $label) {
        $this->lstItems[] = array(
            'value' => $value
            , 'label' => $label
        );
    }

}
