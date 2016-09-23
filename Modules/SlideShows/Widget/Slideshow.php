<?php

class SlideShows_Widget_Slideshow extends Com_Object {

    private $lan;
    private $cat;
    

   /**
     *
     * @static
     * @access public
     * @return SlideShows_Widget_Slideshow 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function setLan($lan) {
        $this->lan = $lan;
        return $this;
    }
    
    public function setCat($cat) {
        $this->category = $cat;
        return $this;
    }

    public function render() {

        $list = SlideShows_Model_SlideShow::getInstance()->getListEnable($this->lan->LanId, $this->category);
        $count = 0;
        foreach ($list as $slide) {
            $count++;
            ?>
                <li class="header-step seq-step<?php echo $count;?>" id="step<?php echo $count;?>"
                    style="background:linear-gradient(rgba(0,0,0,0) 80%, rgba(0,0,0,0.75)), url(<?= Com_Helper_Url::getInstance()->getUploads(); ?>/Image/<?php echo $slide->SliImage; ?>) center center / cover">

                </li>
           
            <?PHP
        }
    }
    public function renderPag() {
        $list = SlideShows_Model_SlideShow::getInstance()->getListEnable($this->lan->LanId, $this->category);
        $count = 0;
        ?>
        
            <?PHP
            foreach ($list as $slide) {
                $count++;
                ?>
                    <li><a href="#step<?php echo $count;?>" rel="step<?php echo $count;?>" title="Go to slide <?php echo $count;?>"><?PHP echo $slide->SliTitle;?></a></li>
                <?PHP
            }
            ?>
       
        <?PHP
    }
}
