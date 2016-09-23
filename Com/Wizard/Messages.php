<?php

class Com_Wizard_Messages extends Com_Object {

    /**
     *
     * @access private
     * @var Array 
     */
    private $lstMessages = array();

    /**
     *
     * @access public
     * @return Com_Wizard_Messages 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    /**
     *
     * @access public
     * @param String $type
     * @param String $message 
     */
    public function addMessage($type, $message) {
        $this->lstMessages[] = array('type' => $type, 'message' => $message);
        set('messageBox', $this->lstMessages, 'SESSION');
    }

    /**
     * 
     * @access public
     */
    public function render() {
        $this->lstMessages = get('messageBox');
        $this->lstMessages = (is_array($this->lstMessages) ? $this->lstMessages : array());
        foreach ($this->lstMessages as $lstMessage) {
            switch ($lstMessage['type']) {
                case MESSAGE_EXCLAMATION: {
                        ?>
                        <div class="alert alert-warning alert-dismissible small" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <strong>Advertencia!</strong>&nbsp;&nbsp;<?PHP echo $lstMessage['message']; ?>
                        </div>
                        <?PHP
                        break;
                    }
                case MESSAGE_INFORMATION: {
                        ?>
                        <div class="alert alert-info alert-dismissible small" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <strong>Informaci&oacute;n!</strong>&nbsp;&nbsp;<?PHP echo $lstMessage['message']; ?>
                        </div>
                        <?PHP
                        break;
                    }
                case MESSAGE_WARNING: {
                        ?>
                        <div class="alert alert-danger alert-dismissible small" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <strong>Alerta!</strong>&nbsp;&nbsp;<?PHP echo $lstMessage['message']; ?>
                        </div>
                        <?PHP
                        break;
                    }
            }
        }
        $this->lstMessages = array();
        set('messageBox', array(), 'SESSION');
    }

}
