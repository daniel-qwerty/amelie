<?php

/**
 * Description of Mail
 *
 * @author aortuno
 */
class Com_Wizard_Mail extends Com_Object {

    /**
     *
     * @access private
     * @var Com_3rdParty_PhpMailer 
     */
    private $mail = null;

    /**
     *
     * @access public
     * @static
     * @return Com_Wizard_Mail
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    /**
     * 
     * @access public
     */
    public function __construct() {
        $this->mail = new Com_3rdParty_PhpMailer();
        if (EMAIL_TYPE == "sendmail") {
            $this->mail->IsSendmail();
        } else {
            $this->mail->IsSMTP(); // telling the class to use SMTP
        }
        //$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
        // 1 = errors and messages
        // 2 = messages only
        $this->mail->SMTPAuth = EMAIL_AUTH;                  // enable SMTP authentication
        $this->mail->Host = EMAIL_HOST; // sets the SMTP server
        $this->mail->Port = EMAIL_PORT;                    // set the SMTP port for the GMAIL server
        $this->mail->Username = EMAIL_USERNAME; // SMTP account username
        $this->mail->Password = EMAIL_PASSWORD;
        $this->mail->IsHTML(true);
        $this->mail->CharSet = "utf-8";
    }

    /**
     *
     * @access public
     * @param String $subject 
     */
    public function setSubject($subject) {
        $this->mail->Subject = $subject;
    }

    /**
     *
     * @access public
     * @param String $altBody 
     */
    public function setAltBody($altBody) {
        $this->mail->AltBody = $altBody;
    }

    /**
     *
     * @access public
     * @param String $email
     * @param String $name 
     */
    public function setFrom($email, $name) {
        $this->mail->SetFrom($email, $name);
    }

    /**
     *
     * @access public
     * @param String $email
     * @param String $name 
     */
    public function addAddress($email, $name) {
        $this->mail->AddAddress($email, $name);
    }

    /**
     *
     * @access public
     * @param String $email
     * @param String $name 
     */
    public function addCC($email, $name) {
        $this->mail->AddCC($email, $name);
    }

    /**
     *
     * @access public
     * @param String $email
     * @param String $name 
     */
    public function addBCC($email, $name) {
        $this->mail->AddBCC($email, $name);
    }

    /**
     *
     * @param String $message 
     */
    public function setMessage($message) {
        $this->mail->MsgHTML($message);
    }

    /**
     *
     * @param String $path
     * @param String $name 
     */
    public function addAttachment($path, $name) {
        $this->mail->AddAttachment($path, $name);
    }

    /**
     *
     * @return Boolean
     */
    public function send() {
        if (!$this->mail->Send()) {
            return false;
        } else {
            return true;
        }
    }

}
