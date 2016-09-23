<?PHP

class Admin_Controller_Index extends Com_Module_Controller {

    public function Index() {
        $this->setLayout('Admin/login');
        $this->setView('login');

        if ($this->isPost()) {
            $obj = Users_Model_User::getInstance()->getLogin(get('User'), get('Password'));
            if ($obj->UserId > 0) {

                set('userId', $obj->UserId, "SESSION");
                set('userFullName', $obj->UserName, "SESSION");
                set('userName', $obj->UserLogin, "SESSION");
                set('userEmail', $obj->UserMail, "SESSION");
                set('userType', $obj->UserTypId, "SESSION");
                set('userPhoto', $obj->UserImage, "SESSION");

               
                $ip = get('REMOTE_ADDR');
                if ($ip != "::1") {
                    //Get geo Data
                    $geoData = Com_Helper_GeoCode::getInstance()->getData($ip);
                    //get Country Data
                    $countryCode = $geoData->country_code;
                } else {
                    $countryCode = "BO";
                }

                $country = Public_Model_Country::getInstance()->getByCode($countryCode);
                //set user country
                set('userCountry', $country, "SESSION");
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Bienvenid(@) : {$obj->UserName}");
                $this->redirect(Com_Helper_Url::getInstance()->urlBase . "/Admin");
            }
            Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_WARNING, "Usuario y/o Codigo de Acceso Incorrecto!!!");
        }
    }

}
