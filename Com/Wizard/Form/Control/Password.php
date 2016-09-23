<?php

class Com_Wizard_Form_Control_Password extends Com_Wizard_Form_Control {

    /**
     * @access public
     */
    public function renderControl() {
        ?>
        <input type="password" class="form-control" name="<?PHP echo $this->name; ?>" id="<?PHP echo $this->name; ?>" value="<?PHP echo $this->default; ?>" <?php echo $this->getParameters(); ?> autocomplete="off">
        <?PHP
    }

}
