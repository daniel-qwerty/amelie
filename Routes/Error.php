<?php

class Routes_Error extends Com_Application_Route {

    public $pattern = "/^(\w+|-)+\/error/";
    public $result = "_0_/Index/Public/Error";

}
