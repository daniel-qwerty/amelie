<?php

class Clients_Controller_Service extends Com_Module_Controller_Json {

    public function Save() {
        if ($this->isPost()) {
            $obj = $this->getPostObject();
            $cli = Clients_Model_Client::getInstance()->getByEmail($obj->Email);
//            print_r(empty($cli->CliId));
            if(empty($cli->CliId)){
                Clients_Model_Client::getInstance()->doInsert($obj, null);

                //$this->sendEmail($obj->Email, $obj->Name, $obj->Message);
                echo json_encode($obj->Cupon);
            }else
                echo json_encode(0);

        }
    }

    private function sendEmail($emailClient, $nameClient, $messageClient) {

        $to = 'daniel@qwerty.com.bo';
        $subject = 'CONTACT FROM WEB';
        $message = '<html><body>';
        $message .= '<h3>NAME: </h3>'.$nameClient.'<br> <h3>MESSAGE: </h3>'.$messageClient;
        $message .= '</body></html>';
        $headers = 'From:'.$emailClient . "\r\n" .
                'Reply-To:'.$emailClient. "\r\n" .
                'Content-Type: text/html; charset=ISO-8859-1\r\n';
                'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);

    }

}
