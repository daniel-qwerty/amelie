<?php

class Com_Wizard_Form_Control_CKEditor extends Com_Wizard_Form_Control {

    /**
     * @access public
     */
    public function renderControl() {
        ?>
        <textarea name="<?PHP echo $this->name; ?>" id="<?PHP echo $this->name; ?>" <?php echo $this->getParameters(); ?> <?PHP echo ($this->readOnly ? "readonly" : ""); ?> class="form-control ckeditor"><?PHP echo $this->default; ?></textarea>
        <?PHP
    }

}
