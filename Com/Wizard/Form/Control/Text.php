<?PHP

class Com_Wizard_Form_Control_Text extends Com_Wizard_Form_Control {

    public $cols = 40;
    public $rows = 3;

    public function renderControl() {
        ?>
        <textarea style="height:auto !important;" 
                  name="<?PHP echo $this->name; ?>" 
                  id="<?PHP echo $this->name; ?>" 
                  rows="<?PHP echo $this->rows; ?>" 
                  cols="<?PHP echo $this->cols; ?>"
                  <?php echo $this->getParameters(); ?> 
                  <?PHP echo ($this->readOnly ? "readonly" : ""); ?> 
                  <?PHP echo ($this->required ? "required" : ""); ?>
                  class="form-control" 
                  placeholder="<?PHP echo $this->placeHolder; ?>"><?PHP echo $this->default; ?></textarea>
        <?PHP
    }

}
?>