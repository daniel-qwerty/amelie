<?PHP

class Com_Wizard_Form_Control_Time extends Com_Wizard_Form_Control {

    /**
     * @access public
     */
    public function renderControl() {
        ?>
        <input type="text" name="<?PHP echo $this->name; ?>" id="<?PHP echo $this->name; ?>" value="<?PHP echo $this->default; ?>" <?php echo $this->getParameters(); ?> maxlength="5" size="6">
        <?PHP
    }

}
?>