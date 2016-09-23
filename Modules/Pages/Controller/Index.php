<?php

class Pages_Controller_Index extends Public_Controller_Index {

    public function Page() {
        Tracking_Model_Tracking::getInstance()->doInsert($_SERVER['REMOTE_ADDR'],Com_Helper_Url::getInstance()->getUrl(),isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '',$_SERVER['PHP_SELF'],date("Y-m-d"),date("H:i:s"),$_SERVER['HTTP_USER_AGENT']);
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];
        $page = Pages_Model_Pages::getInstance()->getByUrl($url, $this->lan->LanId);
        $menu = Menu_Model_Menu::getInstance()->getByUrl("page/" . $page->PagUrl, $this->lan->LanId);



        $this->assign('page', $page);
        $this->assign('menu', $menu);
        $this->assign('parents', Menu_Model_Menu::getInstance()->getParentList($this->lan->LanId, $menu->MenId));
        $this->assign('equals', Menu_Model_Menu::getInstance()->getMenuList($this->lan->LanId, $menu->MenId));
        $this->assign('friends', Menu_Model_Menu::getInstance()->getMenuList($this->lan->LanId, $menu->MenParentId));

        $blocked = array(1, 2, 14);
        if (in_array($menu->MenParentId, $blocked)) {
            $this->assign('friends', array());
        }

        $this->setLayout($page->PagLayout);

        if ($page->PagLayout == "change") {
            $this->setView("change");
        }

        if ($page->PagLayout == "menu") {
            $this->setLayout("page");
            $this->setView("menu");
            $childs = Menu_Model_Menu::getInstance()->getMenuList($this->lan->LanId, $menu->MenId);
            $this->assign("childs", $childs);
        }

        if ($page->PagLayout == "pagemenu") {
            $this->setLayout("pagemenu");
            $this->setView("pagemenu");
            $childs = Menu_Model_Menu::getInstance()->getMenuList($this->lan->LanId, $menu->MenId);
            $this->assign("childs", $childs);
        }
        
        if ($page->PagLayout == "pagemenuw") {
            $this->setLayout("pagemenuw");
            $this->setView("pagemenuw");
        }
    }

}
