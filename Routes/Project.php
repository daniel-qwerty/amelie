<?php

class Routes_Project extends Com_Application_Route {

    public $pattern = "/^(\w+|-)+\/project\/(\w+|-)+.html/";
    public $result = "_0_/Index/Projects/Project/_2_";

}
