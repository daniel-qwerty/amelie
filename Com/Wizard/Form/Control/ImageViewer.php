<?PHP

class Com_Wizard_Form_Control_ImageViewer extends Com_Wizard_Form_Control {

    public function render() {
        ?>
        <div class="form-group form-group-sm fileUploader">
            <label for="<?PHP echo $this->name; ?>" class="col-lg-2 control-label"><?PHP echo ($this->required ? '(*) ' : ''); ?><?PHP echo $this->label; ?></label>
            </br>
            <div class="col-lg-12">
                <ul class="imageViewer">
                    <?PHP $this->renderControl(); ?>
                </ul>
            </div>
        </div>
        <?PHP
    }

    /**
     * @access public
     */
    public function renderControl() {
        foreach ($this->default as $obj) {
            ?>
            <li>
                <img src="<?PHP echo Com_Helper_Url::getInstance()->getResources(); ?>/Uploads/Image/<?PHP echo $obj->MedFile; ?>"/>
            </li>
            <?PHP
        }
    }

}

