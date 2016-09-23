<?PHP

class Com_Helper_Panel extends Com_Object {

    /**
     *
     * @access private
     * @var Array
     */
    private $lstItems = array();

    /**
     *
     * @static
     * @access public
     * @return Com_Helper_Panel 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    /**
     *
     * @access public
     * @param String $image
     * @param String $label
     * @param String $href
     * @param String $strAction 
     */
    public function add($image, $label, $href = "", $action = "") {
        $this->lstItems[] = array(
            'image' => 'glyphicon glyphicon-'.$image
            , 'label' => $label
            , 'href' => $href
            , 'action' => $action
        );
    }

    /**
     * @access public
     */
    public function render() {
        ?>
        <div class="bs-glyphicons">
            <ul class="bs-glyphicons-list">
                <?PHP
                foreach ($this->lstItems as $lstIcon) {
                    ?>
                    <li>
                        <a <?PHP
                        echo ($lstIcon['href'] != "" ? 'href="' . Com_Helper_Url::getInstance()->urlBase . $lstIcon['href'] . '"' : "");
                        echo ($lstIcon['action'] != "" ? 'onclick="' . $lstIcon['action'] . '"' : "");
                        ?> 
                            title="<?PHP echo $lstIcon['label']; ?>" alt="<?PHP echo $lstIcon['label']; ?>">
                            <span class="<?PHP echo $lstIcon['image']; ?>"></span>
                            <div class="text"><?PHP echo $lstIcon['label']; ?></div>
                        </a>
                    </li>
                    <?PHP
                }
                ?>
            </ul>
            <div class="clear"></div>
        </div>
        <?PHP
    }

}