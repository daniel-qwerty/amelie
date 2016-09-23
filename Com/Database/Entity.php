<?php

class Com_Database_Entity extends Com_Object {

    /**
     * Entity table name persistant 
     * @var String 
     */
    public $tableName;

    /**
     * Entity key field name
     * @access public
     * @var String 
     */
    public $keyField;

    /**
     * Entity state type
     * @access public
     * @var String 
     */
    public $action = ACTION_NONE;

    /**
     * Entity array fields
     * @access private
     * @var Arrays 
     */
    private $lstFields = array();

    /**
     *
     * @access public
     * @var Arrays
     */
    public $lstExcludedFields = array();

    /**
     *
     * @static
     * @access public
     * @return Com_Database_Entity 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    /**
     * 
     * @access public
     */
    public function __construct() {
        $this->tableName = DATABASE_PREFIX . $this->tableName;
        $this->prepareFields();
    }

    /**
     * 
     * @access private
     */
    protected function prepareFields($excludeFields = true) {
        foreach ($this as $index => $varValue) {
            if ($index != "tableName" && $index != "lanField" && $index != "keyField" && $index != "lstFields" && $index != "action" && $index != "lstExcludedFields") {
                if ((!in_array($index, $this->lstExcludedFields)) && $excludeFields) {
                    $this->lstFields[$index] = $varValue;
                }
            }
        }
    }

    protected function getFields($excludeFields = true) {
        $lstResult = array();
        foreach ($this as $index => $value) {
            if ($index != "tableName" && $index != "lanField" && $index != "keyField" && $index != "lstFields" && $index != "action" && $index != "lstExcludedFields") {
                if ((!in_array($index, $this->lstExcludedFields)) && $excludeFields) {
                    $lstResult[] = $index;
                }
            }
        }
        return $lstResult;
    }

    protected function getFieldsWithValues($excludeFields = true) {
        $lstResult = array();
        foreach ($this as $index => $value) {
            if ($index != "tableName" && $index != "lanField" && $index != "keyField" && $index != "lstFields" && $index != "action" && $index != "lstExcludedFields" && ($value != "" || $value == "0")) {
                if ((!in_array($index, $this->lstExcludedFields)) && $excludeFields) {
                    $lstResult[$index] = $value;
                }
            }
        }
        return $lstResult;
    }

    protected function getFieldsWithOutValues($excludeFields = true) {
        $lstResult = array();
        foreach ($this as $index => $value) {
            if ($index != "tableName" && $index != "lanField" && $index != "keyField" && $index != "lstFields" && $index != "action" && $index != "lstExcludedFields") {
                if ((!in_array($index, $this->lstExcludedFields)) && $excludeFields) {
                    $lstResult[$index] = $value;
                }
            }
        }
        return $lstResult;
    }

    protected function load($object) {
        foreach ($object as $index => $value) {
            $this->$index = $value;
        }
    }

    /**
     *
     * @access public
     * @return Boolean 
     */
    public function get() {
        $lstFields = $this->getFieldsWithValues();
        foreach ($lstFields as $index => $value) {
            $lstFields[$index] = "{$index}='{$value}'";
        }
        $lstFields = implode(" AND ", $lstFields);
        $lstFields = (strlen($lstFields) > 0 ? " WHERE " . $lstFields : "");
        $sqlQuery = "SELECT * FROM {$this->tableName} {$lstFields}";
        
         
        if (Com_Database_Connection::getInstance()->execute($sqlQuery)) {
            $this->load(Com_Database_Connection::getInstance()->getObject());
            return true;
        }
        return false;
    }

    /**
     *
     * @access public
     * @return Boolean 
     */
    public function getAll($sqlQuery = "") {

        if ($sqlQuery == "") {
            $lstFields = $this->getFieldsWithValues();
            foreach ($lstFields as $index => $value) {
                $lstFields[$index] = "{$index}='{$value}'";
            }
            $lstFields = implode(" AND ", $lstFields);
            $lstFields = (strlen($lstFields) > 0 ? " WHERE " . $lstFields : "");
            $sqlQuery = "SELECT * FROM {$this->strTableName} {$lstFields}";
            
           
        }
        $lstResult = array();
        if (Com_Database_Connection::getInstance()->execute($sqlQuery)) {
            $results = Com_Database_Connection::getInstance()->getNumberRegistries();
            for ($counter = 0; $counter < $results; $counter++) {
                $lstResult[] = Com_Database_Connection::getInstance()->getObject();
            }
        }
        
        
        return $lstResult;
    }

    /**
     *
     * @access private
     * @return Boolean 
     */
    protected function doInsert() {
        $lstFields = $this->getFieldsWithValues();
        $values = implode("','", $lstFields);

        foreach ($lstFields as $index => $value) {
            $lstFields[$index] = $index;
        }
        $lstFields =  implode(",", $lstFields);
        $sqlQuery = "INSERT INTO {$this->tableName} ({$lstFields}) values
                                            ('{$values}')";

        $result = false;
        Com_Database_Connection::getInstance()->execute($sqlQuery);
        $keyField = $this->keyField;
        $this->$keyField = Com_Database_Connection::getInstance()->getLastId();
        if ($this->keyField > 0) {
            $result = true;
        }

        if (DEBUG_MODE) {
            Com_3rdParty_FirePHP::getInstance(true)->group("Database Insert");
            Com_3rdParty_FirePHP::getInstance(true)->log($this->tableName, "Entity");
            $lstFields = $this->getFieldsWithValues();
            foreach ($lstFields as $index => $value) {
                Com_3rdParty_FirePHP::getInstance(true)->log($value, $index);
            }
            Com_3rdParty_FirePHP::getInstance(true)->log($sqlQuery, "Query");
            Com_3rdParty_FirePHP::getInstance(true)->groupEnd();
        }

        return $result;
    }

    /**
     *
     * @access private
     * @return Boolean 
     */
    protected function doUpdate() {
        $lstFields = $this->getFieldsWithValues();
     
        foreach ($lstFields as $index => $value) {
            $lstFields[$index] = "{$index}='{$value}'";
        }
        $lstFields = implode(",", $lstFields);
        $keyField = $this->keyField;
        $sqlQuery = "UPDATE {$this->tableName} SET {$lstFields} WHERE {$keyField}='{$this->$keyField}'";
        
        //print_r($sqlQuery);
        //exit();

        if (DEBUG_MODE) {
            Com_3rdParty_FirePHP::getInstance(true)->group("Database Update");
            Com_3rdParty_FirePHP::getInstance(true)->log($this->tableName, "Entity");
            $lstFields = $this->getFieldsWithValues();
            foreach ($lstFields as $index => $value) {
                Com_3rdParty_FirePHP::getInstance(true)->log($value, $index);
            }
            Com_3rdParty_FirePHP::getInstance(true)->log($sqlQuery, "Query");
            Com_3rdParty_FirePHP::getInstance(true)->groupEnd();
        }

        return Com_Database_Connection::getInstance()->execute($sqlQuery);
    }

    /**
     *
     * @access private
     * @return Boolean 
     */
    protected function doDelete() {
        $lstFields = $this->getFieldsWithValues();
        
        foreach ($lstFields as $index => $value) {
            $lstFields[$index] = "{$index}='{$value}'";
        }
        
        $lstFields = implode(" AND ", $lstFields);
        $lstFields = (strlen($lstFields) > 0 ? " WHERE " . $lstFields : "");
        $sqlQuery = "DELETE FROM {$this->tableName} {$lstFields}";
        
        if (DEBUG_MODE) {
            Com_3rdParty_FirePHP::getInstance(true)->group("Database Delete");
            Com_3rdParty_FirePHP::getInstance(true)->log($this->tableName, "Entity");
            $lstFields = $this->getFieldsWithValues();
            foreach ($lstFields as $index => $value) {
                Com_3rdParty_FirePHP::getInstance(true)->log($value, $index);
            }
            Com_3rdParty_FirePHP::getInstance(true)->log($sqlQuery, "Query");
            Com_3rdParty_FirePHP::getInstance(true)->groupEnd();
        }

        return Com_Database_Connection::getInstance()->execute($sqlQuery);
    }

    /**
     *
     * @access public
     * @return Boolean 
     */
    public function save() {
        switch ($this->action) {
            case ACTION_INSERT: {
                    return $this->doInsert();
                    break;
                }
            case ACTION_UPDATE: {
                    return $this->doUpdate();
                    break;
                }
            case ACTION_DELETE: {
                    return $this->doDelete();
                    break;
                }
        }
        return false;
    }

    public function getList() {
        return Com_Database_Query::getInstance()->select()->from($this->tableName);
    }

    /**
     *
     * @access public
     * @return String 
     */
    public function __toString() {
        return $this->tableName;
    }

}
