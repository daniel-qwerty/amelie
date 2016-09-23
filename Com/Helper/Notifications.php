<?PHP

class Com_Helper_Notifications extends Com_Object {

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
     * @return Com_Helper_Notifications 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    /**
     *
     * @access public
     * @param String $type
     * @param String $message 
     */
    public function add($type, $message) {
        $this->lstItems[] = array('type' => $type, 'message' => $message);
    }

    /**
     * @access public
     */
    public function render() {

        if (count($this->lstItems) > 0) {

            foreach ($this->lstItems as $lstMessage) {
                switch ($lstMessage['type']) {
                    case MESSAGE_EXCLAMATION: {
                            ?>
                            <div class="messageExclamation">
                                <?PHP echo $lstMessage['message']; ?>
                            </div>
                            <?PHP
                            break;
                        }
                    case MESSAGE_INFORMATION: {
                            ?>
                            <div class="messageInformation">
                                <?PHP echo $lstMessage['message']; ?>
                            </div>
                            <?PHP
                            break;
                        }
                    case MESSAGE_WARNING: {
                            ?>
                            <div class="messageWarning">
                                <?PHP echo $lstMessage['message']; ?>
                            </div>
                            <?PHP
                            break;
                        }
                }
            }
        } else {
            ?>
            <div class="messageInformation">
                No existen nuevas Notificaciones
            </div>
            <?PHP
        }
    }

}
?>