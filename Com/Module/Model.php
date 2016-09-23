<?php

class Com_Module_Model extends Com_Object {
    
    /**
     *
     * @access public
     * @param String $type
     * @param String $message 
     */
    public function addMessage($type, $message) {
        Com_Wizard_Messages::getInstance()->addMessage($type, $message);
    }

}
