<?PHP

class Admin_Model_Model extends Com_Module_Model {
    
    
    /**
     *
     * @return Admin_Model_Model 
     */
    public static function getInstance(){
        return self::_getInstance(__CLASS__);
    }   
     
}

?>