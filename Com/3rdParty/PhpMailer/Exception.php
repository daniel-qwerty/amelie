<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Exception
 *
 * @author aortuno
 */
class Com_3rdParty_PhpMailer_Exception extends Exception {

    public function errorMessage() {
        $errorMsg = '<strong>' . $this->getMessage() . "</strong><br />\n";
        return $errorMsg;
    }

}

?>
