<?php

class Com_Database_Entity_Language extends Com_Database_Entity {

    /**
     * Entity key field name
     * @access public
     * @var String 
     */
    public $lanField;

    /**
     *
     * @static
     * @access public
     * @return Com_Database_Entity_Language 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function getNextId() {
        $query = "select max({$this->keyField}) as nextId from {$this->tableName}";
        Com_Database_Connection::getInstance()->execute($query);
        return (Com_Database_Connection::getInstance()->getObject()->nextId + 1);
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
        $lanField = $this->lanField;
        $sqlQuery = "UPDATE {$this->tableName} SET {$lstFields} WHERE {$keyField}='{$this->$keyField}' and {$lanField}='{$this->$lanField}'";

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

    public function getListWithLanguages() {
        $language = new Entities_Language();
        $lanField = $this->lanField;
        return Com_Database_Query::getInstance()->select(array("{$language}.*", "{$this}.*"))
                        ->from($this->tableName)
                        ->innerJoin($language, "LanId={$lanField}");
    }

    public function getList() {
        $fields = $this->getFields();
        $lanField = $this->lanField;
        $newfields = array();
        foreach ($fields as $field) {
            if ($field != $lanField) {
                $newfields[] = $field;
            }
        }
        $newfields = implode(",", $newfields);
        
        
        return Com_Database_Query::getInstance()->select("distinct " . $newfields)
                        ->from($this->tableName);
    }

    public function getListQuery() {
        return Com_Database_Query::getInstance()->select()->from($this->tableName);
    }

}
