<?php

class Com_Wizard_Form_Control_Editor extends Com_Wizard_Form_Control {

    /**
     * @access public
     */
    public function renderControl() {
        ?>
        <textarea name="<?PHP echo $this->name; ?>" id="<?PHP echo $this->name; ?>" <?php echo $this->getParameters(); ?> <?PHP echo ($this->readOnly ? "readonly" : ""); ?> class="form-control htmlEditor"><?PHP echo $this->default; ?></textarea>
        <?PHP
    }

}
