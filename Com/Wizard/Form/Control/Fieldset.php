<?php

class Com_Wizard_Form_Control_Fieldset extends Com_Wizard_Form_Control {

    /**
     * @access public
     */
    public function render() {
        ?>
        <div class="componente">
            <div class="label"><?PHP echo $this->label; ?></div>
            <div class="control"><?PHP $this->renderControl(); ?></div>
        </div>
        <?PHP
    }

    /**
     * @access public
     */
    public function renderControl() {
        ?>
        <fieldset name="<?PHP echo $this->name; ?>" id="<?PHP echo $this->name; ?>" <?php echo $this->getParameters(); ?>>
            <legend><?PHP echo $this->toolTip; ?></legend>
        </fieldset>
        <?PHP
    }

}
