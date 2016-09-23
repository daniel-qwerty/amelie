<?php


class Com_File_Manager extends Com_Object {

    /**
     *
     * @return Com_File_Manager
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    /**
     *
     * @param String $directoryName
     * @param Array $lstExcludedFiles
     * @return Array
     */
    public function readDirectory($directoryName, $lstExcludedFiles=array()) {
        $directory = opendir($directoryName);
        $lstFiles = array();
        while (($file = readdir($directory)) !== false) {
            if ($file !== '.' && $file !== '..' && !in_array($file, $lstExcludedFiles)) {
                $lstFiles[] = $file;
            }
        }
        return $lstFiles;
    }
    
    /**
     *
     * @param String $directoryName
     * @param Array $lstExcludedFiles
     * @return Array
     */
    public function funGetFiles($directoryName, $lstExcludedFiles=array()) {
        $lstResult = array();
        $lstFiles = $this->readDirectory($directoryName, $lstExcludedFiles);
        foreach ($lstFiles as $fileName) {
            if (is_file($directoryName . "/" . $fileName)) {
                $lstResult[] = $fileName;
            }
        }
        return $lstResult;
    }

}