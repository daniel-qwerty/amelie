<?PHP

class Com_Wizard_Form_Control_DatePicker extends Com_Wizard_Form_Control {

    /**
     * @access public
     */
    public function renderControl() {
        ?>
        <input type="text" id="<?PHP echo $this->name; ?>" name="<?PHP echo $this->name; ?>" rel="datepicker" class="form-control">
        <?PHP
    }

}
