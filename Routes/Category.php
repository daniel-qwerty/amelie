<?php

class Routes_Category extends Com_Application_Route {

    public $pattern = "/^(\w+|-)+\/category\/(\w+|-)+.html/";
    public $result = "_0_/Index/Blogs/Category/_2_";

}
