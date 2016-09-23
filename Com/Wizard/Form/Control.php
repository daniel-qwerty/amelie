<?php

class Com_Wizard_Form_Control extends Com_Object {

    /**
     *
     * @access public
     * @var String 
     */
    public $label;

    /**
     *
     * @access public
     * @var String 
     */
    public $name;

    /**
     *
     * @access public
     * @var Integer 
     */
    public $maxCharacters = 150;

    /**
     *
     * @access public
     * @var Integer
     */
    public $length;

    /**
     *
     * @access public
     * @var Boolean
     */
    public $required = false;

    /**
     *
     * @access public
     * @var Boolean
     */
    public $readOnly = false;

    /**
     *
     * @access public
     * @var String
     */
    public $message;

    /**
     *
     * @access public
     * @var String
     */
    public $toolTip;

    /**
     *
     * @access public
     * @var Variant
     */
    public $default;

    /**
     *
     * @access public
     * @var Array
     */
    public $lstParameters = array();

    /**
     *
     * @access public
     * @var String 
     */
    public $placeHolder = "";

    /**
     *
     * @access public
     * @var String 
     */
    public $withAddon = false;

    /**
     * Construct
     */
    public function __construct() {
        $this->init();
    }

    /**
     * Initialize component
     */
    public function init() {
        
    }

    /**
     *
     * @access public
     * @return String 
     */
    public function getParameters() {
        $strParameters = '';
        if (is_array($this->lstParameters) && count($this->lstParameters) > 0) {
            foreach ($this->lstParameters as $key => $value) {
                $strParameters.=$key . ' = "' . $value . '"';
            }
        }

        if ($this->required) {
            $strParameters.='mandatory = "true"';
        }

        return $strParameters;
    }

    /**
     *
     * @access public
     * @param String $key
     * @param String $value 
     */
    public function addParameter($key, $value) {
        $this->lstParameters[$key] = $value;
    }

    /**
     * @access public
     */
    public function render() {
        ?>

        <div class="form-group">
            <label for="<?PHP echo $this->name; ?>" class="col-sm-3 control-label"><?PHP echo ($this->required ? '(*) ' : ''); ?><?PHP echo $this->label; ?></label>

            <div class="col-sm-9">
                <?PHP $this->renderControl(); ?>
            </div>
        </div>
        <?PHP
    }

    /**
     * @access public
     */
    public function renderControl() {
        ?>
        <input type="text" class="form-control" name="<?PHP echo $this->name; ?>"  
               placeholder="<?PHP echo $this->placeHolder; ?>"
               id="<?PHP echo $this->name; ?>" value="<?PHP echo $this->default; ?>" 
               title="<?PHP echo $this->toolTip; ?>" alt="<?PHP echo $this->toolTip; ?>" 
               size="<?PHP echo $this->length; ?>" maxlength="<?PHP echo $this->maxCharacters; ?>" 
               <?PHP echo ($this->readOnly ? "readonly" : ""); ?> <?php echo $this->getParameters(); ?>
               <?PHP echo ($this->required ? "required" : ""); ?>>
        <?PHP
    }

    public function postInit() {
        
    }

    public function __destruct() {
        $this->postInit();
    }

}
