<?php

class Com_Wizard_Form_Control_Date extends Com_Wizard_Form_Control {

    /**
     * @access public
     */
    public function renderControl() {
        $this->default = ($this->default != "" ? $this->default : date("Y-m-d"));
        $this->default = explode("-", $this->default);
        ?>
        <div class="form-contro-date">
            <select name="<?PHP echo $this->name; ?>Day" id="<?PHP echo $this->name; ?>Day" style="width:53px;" class="form-control">
                <?PHP
                for ($intCounter = 1; $intCounter < 32; $intCounter++) {
                    ?>
                    <option value="<?PHP echo ($intCounter < 10 ? '0' . $intCounter : $intCounter); ?>" <?PHP echo ($this->default[2] == $intCounter ? "selected" : ""); ?>><?PHP echo ($intCounter < 10 ? '0' . $intCounter : $intCounter); ?></option>
                    <?PHP
                }
                ?>
            </select> /
            <select name="<?PHP echo $this->name; ?>Month" id="<?PHP echo $this->name; ?>Month" style="width:53px;" class="form-control">
                <?PHP
                for ($intCounter = 1; $intCounter < 13; $intCounter++) {
                    ?>
                    <option value="<?PHP echo ($intCounter < 10 ? '0' . $intCounter : $intCounter); ?>" <?PHP echo ($this->default[1] == $intCounter ? "selected" : ""); ?>><?PHP echo ($intCounter < 10 ? '0' . $intCounter : $intCounter); ?></option>
                    <?PHP
                }
                ?>
            </select> /
            <select name="<?PHP echo $this->name; ?>Year" id="<?PHP echo $this->name; ?>Year" style="width:73px;" class="form-control">
                <?PHP
                for ($intCounter = (date("Y") - 40); $intCounter < (date("Y") + 10); $intCounter++) {
                    ?>
                    <option value="<?PHP echo $intCounter; ?>" <?PHP echo ($this->default[0] == $intCounter ? "selected" : ""); ?>><?PHP echo $intCounter; ?></option>
                    <?PHP
                }
                ?>
            </select>
            <input type="hidden" name="<?PHP echo $this->name; ?>" id="<?PHP echo $this->name; ?>"  rel="date">
        </div>
        <?PHP
    }

}
