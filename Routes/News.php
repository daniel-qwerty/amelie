<?php

class Routes_News extends Com_Application_Route {

    public $pattern = "/^(\w+|-)+\/news/";
    public $result = "_0_/Index/News/";

}
