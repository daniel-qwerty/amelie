<?php

class Routes_Page extends Com_Application_Route {

    public $pattern = "/^(\w+|-)+\/page\/(\w+|-)+.html/";
    public $result = "_0_/Index/Pages/Page/_2_";

}
