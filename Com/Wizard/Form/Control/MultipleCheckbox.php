<?PHP

class Com_Wizard_Form_Control_MultipleCheckbox extends Com_Wizard_Form_Control {

    /**
     *
     * @access private
     * @var Array
     */
    private $lstItems = array();

    public function __construct() {
        $this->default = array();
    }

    /**
     * @access public
     */
    public function renderControl() {
        if (!(is_array($this->default))) {
            $this->default = array();
        }
        foreach ($this->lstItems as $lstItem) {
            ?>
            <input type="checkbox" name="<?PHP echo $this->name; ?>[]" value="<?PHP echo $lstItem['value']; ?>" <?PHP echo (in_array($lstItem['value'], $this->default) ? 'checked' : ''); ?>>
            <label><?PHP echo $lstItem['label']; ?></label>
            <br>
            <?PHP
        }
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
