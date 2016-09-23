<?php

class Contact_Controller_Index extends Public_Controller_Index {

    
    public function Step() {
        $this->setLayout("wizard");
        $this->setView("step1");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];
       
        //print_r($url);
        //exit();
        
        //$blog = Articles_Model_BlogItem::getInstance()->getListArticlesRecent($this->lan->LanId, 10);
       // $this->assign("blog", $blog);
        
    }

}
