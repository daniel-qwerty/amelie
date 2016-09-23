<?php

class Pages_Widget_Modal extends Com_Object {

    private $lan;
    private $translator;

    /**
     *
     * @static
     * @access public
     * @return Pages_Widget_Modal 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function setLan($lan) {
        $this->lan = $lan;
        return $this;
    }

    public function setTranslator($translator) {
        $this->translator = $translator;
        return $this;
    }

    public function render() {
        $page = Pages_Model_Pages::getInstance()->getForModal($this->lan->LanId);
        if ($page->PagId > 0) {
            ?>
            <div class="modalWindow">
                <div class="title">
                    <?PHP echo $page->PagName; ?>
                </div>
                <div class="content">
                    <div class="image">
                        <img src="<?PHP echo Com_Helper_Url::getInstance()->getUploads(); ?>/Image/<?PHP echo $page->PagImage; ?>"/>
                    </div>
                    <?PHP echo $page->PagContent; ?>
                </div>
                <div class="link">
                    <a href="<?PHP echo $page->PagAditional; ?>" target="_blank">
                        <?PHP echo $this->translator->readMore; ?>
                    </a>
                </div>
            </div>
            <?PHP
        }
    }

}
