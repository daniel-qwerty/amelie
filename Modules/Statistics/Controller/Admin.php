<?php


class Statistics_Controller_Admin extends Admin_Controller_Admin{
    
    
    public function Index(){
        
        Com_Helper_Title::getInstance()->title="M&oacute;dulo de Estad&iacute;sticas";
        
        Com_Helper_BreadCrumbs::getInstance()->add("Estad&iacute;sticas", "/Admin/Statistics");
        
        $dtaActual=date("Y-m-d");
        $dtaStart=mktime(date("H"), date("i"),date("s"), date("m")-1, date("d"), date("Y"));
        $dtaStart=date("Y-m-d",$dtaStart);
        $this->assign("Statistics", Statistics_Model_Visit::getInstance()->getList($dtaStart, $dtaActual));
    }
    
}