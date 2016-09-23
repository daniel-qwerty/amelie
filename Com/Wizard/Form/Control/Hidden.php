<?php

class Com_Wizard_Form_Control_Hidden extends Com_Wizard_Form_Control {

    /**
     * @access public
     */
    public function render() {
        ?>
        <input type="hidden" name="<?PHP echo $this->name; ?>" id="<?PHP echo $this->name; ?>" value="<?PHP echo $this->default; ?>" <?php echo $this->getParameters(); ?>>
        <?PHP
    }

}
