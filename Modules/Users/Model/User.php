<?php

class Users_Model_User extends Com_Module_Model {

    /**
     *
     * @return Users_Model_User
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert($strName, $strMail, $strLogin, $strPassword, $bolStatus, $intType, $image) {
        $db = new Entities_User();
        $db->UserTypId = $intType;
        $db->UserName = $strName;
        $db->UserImage = $image;
        $db->UserMail = $strMail;
        $db->UserLogin = $strLogin;
        $db->UserPassword = md5($strPassword);
        $db->UserEstado = $bolStatus;
        $db->action = ACTION_INSERT;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");
    }

    public function doUpdate($intId, $strName, $strMail, $strLogin, $strPassword, $bolStatus, $intType,$image) {
       
        $db = new Entities_User();
        $db->UserId = $intId;
        $db->UserTypId = $intType;
        $db->UserName = $strName;
        if ($image != "") {
            $db->UserImage = $image;
        }
        $db->UserMail = $strMail;
        $db->UserLogin = $strLogin;
        if (strlen($strPassword) > 0) {
            $db->UserPassword = md5($strPassword);
        }
        $db->UserEstado = $bolStatus;
        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }

    public function doDelete($intId) {
        $db = new Entities_User();
        $db->UserId = $intId;
        $db->action = ACTION_DELETE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function get($intId) {
        $db = new Entities_User();
        $db->UserId = $intId;
        $db->get();
        return $db;
    }

    public function getLogin($user, $password) {
        $db = new Entities_User();
        $db->UserLogin = $user;
        $db->UserPassword = md5($password);
        $db->get();
        echo($db);
        return $db;
    }
    
    public function getList() {
         echo "getList";
        $text = new Entities_User();
        return $text->getAll($text->getList());
    }

}
