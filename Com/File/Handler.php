<?PHP

class Com_File_Handler extends Com_Object {

    /**
     *
     * @access private
     * @var Strings
     */
    private $fileName;

    /**
     *
     * @access private
     * @var Object
     */
    private $file;

    /**
     *
     * @access private
     * @var Array
     */
    private $lstValidExtensions = array();

    /**
     *
     * @access private
     * @var Array
     */
    private $lstInvalidExtensions = array();

    /**
     *
     * @static
     * @access public
     * @return Com_File_Handler 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    /**
     *
     * @access public
     * @param type $extension
     * @return Com_File_Handler 
     */
    public function addValidExtension($extension) {
        $this->lstValidExtensions[$extension] = $extension;
        return $this;
    }

    /**
     *
     * @access public
     * @param type $extension
     * @return Com_File_Handler 
     */
    public function addInvalidExtension($extension) {
        $this->lstInvalidExtensions[$extension] = $extension;
        return $this;
    }

    /**
     *
     * @access public
     * @param String $file
     * @return Com_File_Handler 
     */
    public function setFile($file) {
        $this->file = $file;
        return $this;
    }

    /**
     *
     * @return Boolean 
     */
    public function hasErrors() {
        return ($this->file["error"] > 0 ? true : false);
    }

    /**
     *
     * @access public
     * @param String $strNewFileName
     * @param Boolean $bolValidateExtensions 
     * 
     */
    public function saveFile($directory = "Resources/Uploads", $newFileName = "", $validateExtensions = false) {
        $newFileName = ($newFileName != "" ? $newFileName : uniqid());
        if ($this->file["error"] == 0) {
            $this->fileName = $this->file["name"];
            $extension = explode(".", $this->fileName);
            $extension = end($extension);
            $this->fileName = $newFileName . "." . $extension;
            $destination = Com_Helper_Url::getInstance()->physicalDirectory . "/" . $directory . "/" . $this->fileName;
            if (move_uploaded_file($this->file["tmp_name"], $destination)) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    /**
     *
     * @return String
     */
    public function getFileName() {
        return $this->fileName;
    }

}
