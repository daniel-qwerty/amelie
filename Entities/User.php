<?php

class Entities_User extends Com_Database_Entity {

    public $tableName = "User";
    public $keyField = "UserId";
    public $UserId;
    public $UserTypId;
    public $UserName;
    public $UserMail;
    public $UserLogin;
    public $UserPassword;
    public $UserImage;
    public $UserEstado;

    public function funGetList() {
        $group = new Entities_Type();
        return Com_Database_Query::getInstance()->select(array("TypName", "UserId", "UserName", "UserMail", "UserLogin", "UserPassword", "UserImage", "UserEstado"))
                        ->from($this)
                        ->innerJoin($group, "TypId=UserTypId")
                        ->orderBy("TypName")
                        ->orderBy("UserName");
    }

}
