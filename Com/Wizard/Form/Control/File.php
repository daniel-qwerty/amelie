<?PHP

class Com_Wizard_Form_Control_File extends Com_Wizard_Form_Control {

    public $isImage = false;

    public function render() {
        ?>
        <div class="form-group form-group-sm fileUploader">
            <label for="<?PHP echo $this->name; ?>" class="col-lg-3 control-label"><?PHP echo ($this->required ? '(*) ' : ''); ?><?PHP echo $this->label; ?></label>
            <div class="col-lg-9">
                <?PHP $this->renderControl(); ?>
            </div>
        </div>

        <?PHP
    }

    /**
     * @access public
     */
    public function renderControl() {
        if (!$this->isImage) {
            ?>
            <span><?php echo $this->default; ?></span><br>
            <?php
        } else if ($this->default != "") {
            ?>
            <img src="<?PHP echo Com_Helper_Url::getInstance()->getResources() . '/Uploads/Image/' . $this->default; ?>"/><br/>
            <?PHP
        }
        ?>
        <input class="file " type="file" name="<?PHP echo $this->name; ?>" id="<?PHP echo $this->name; ?>" <?php echo $this->getParameters(); ?> onchange="$('#<?PHP echo $this->name; ?>Name').val($('#<?PHP echo $this->name; ?>').val());">
        <input type="text" class="text form-control" style="max-width:250px;" name="<?PHP echo $this->name; ?>Name" id="<?PHP echo $this->name; ?>Name" <?php echo $this->getParameters(); ?> readonly="true">
        <input type="button" value="Examinar" onclick="$('#<?PHP echo $this->name; ?>Name').click();" class="browser form-control" style="max-width: 250px; background-color: #008CBA;color:#FFF;"/> 
        <?PHP
    }

}
