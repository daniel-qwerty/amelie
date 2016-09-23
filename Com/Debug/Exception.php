<?php

class Com_Debug_Exception extends Exception {

    /**
     *
     * @access public
     * @param String $message
     * @param Integer $errorNumber 
     */
    public function __construct($message, $errorNumber) {
        $this->generateLogFile($message, $errorNumber);
    }

    /**
     *
     * @access private
     * @param String $errorNumber
     * @param Integer $message 
     */
    private function generateLogFile($errorNumber, $message) {
        printf("%02d/%02d/%04d\t%02d:%02d:%02d\t%s\t%s\t%s\n"
                , date('d'), date('m'), date('Y'), date('H'), date('i'), date('s')
                , get('REMOTE_ADDR'), $errorNumber, $message);
        exit;
    }

}
