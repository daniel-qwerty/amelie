<?php


class Com_Database_Query extends Com_Object {

    /**
     *
     * @access private
     * @var Array
     */
    private $lstFields = array();
    /**
     *
     * @access private
     * @var Array
     */
    private $lstTables = array();
    /**
     *
     * @access private
     * @var Array
     */
    private $lstLinks = array();
    /**
     *
     * @access private
     * @var Array
     */
    private $lstConditions = array();
    /**
     *
     * @access private
     * @var Array
     */
    private $lstGroup = array();
    /**
     *
     * @access private
     * @var Array
     */
    private $lstOrder = array();
    /**
     *
     * @access private
     * @var Integer
     */
    private $begin = 0;
    /**
     *
     * @access private
     * @var Integer
     */
    private $numberOfItems = 1000;

    /**
     *
     * @static
     * @access public
     * @return Com_Database_Query 
     */
    public static function getInstance() {
        return new Com_Database_Query();
    }

    /**
     *
     * @access public
     * @param Array/String $lstFields
     * @return Com_Database_Query 
     */
    public function select($lstFields="*") {
        if (is_array($lstFields)) {
            $this->lstFields = $lstFields;
        } else {
            $this->lstFields[] = $lstFields;
        }

        return $this;
    }

    /**
     *
     * @access public
     * @param String $table
     * @return Com_Database_Query 
     */
    public function from($table) {
        $this->lstTables[] = (String) $table;
        return $this;
    }

    /**
     *
     * @access public
     * @param String $table
     * @param String $link
     * @return Com_Database_Query 
     */
    public function innerJoin($table, $link) {
        $this->lstLinks[] = array(
            'table' => (String)$table
            , 'type' => 'INNER JOIN'
            , 'link' => $link
        );
        return $this;
    }

    /**
     *
     * @access public
     * @param String $table
     * @param String $link
     * @return Com_Database_Query 
     */
    public function leftJoin($table, $link) {
        $this->lstLinks[] = array(
            'table' => (String)$table
            , 'type' => 'LEFT JOIN'
            , 'link' => $link
        );
        return $this;
    }

    /**
     *
     * @access public
     * @param String $table
     * @param String $link
     * @return Com_Database_Query 
     */
    public function rightJoin($table, $link) {
        $this->lstLinks[] = array(
            'table' => (String)$table
            , 'type' => 'RIGHT JOIN'
            , 'link' => $link
        );
        return $this;
    }

    /**
     *
     * @access public
     * @param String $table
     * @param String $link
     * @return Com_Database_Query 
     */
    public function outerJoin($table, $link) {
        $this->lstLinks[] = array(
            'table' => (String)$table
            , 'type' => 'OUTER JOIN'
            , 'link' => $link
        );
        return $this;
    }

    /**
     *
     * @access public
     * @param String $table
     * @param String $link
     * @return Com_Database_Query 
     */
    public function crossJoin($table, $link) {
        $this->lstLinks[] = array(
            'table' => (String)$table
            , 'type' => 'CROSS JOIN'
            , 'link' => $link
        );
        return $this;
    }
    
    /**
     *
     * @access public
     * @return Boolean 
     */
    public function hasConditions() {
        return (count($this->lstConditions) > 0 ? true : false);
    }

    /**
     *
     * @access public
     * @param String $condition
     * @return Com_Database_Query 
     */
    public function where($condition) {
        
        $this->lstConditions[] = array(
            'condition' => $condition
            , 'type' => ''
        );
        return $this;
    }

    /**
     *
     * @access public
     * @param String $condition
     * @return Com_Database_Query 
     */
    public function andWhere($condition) {
        $this->lstConditions[] = array(
            'condition' => $condition
            , 'type' => 'AND'
        );
        return $this;
    }

    /**
     *
     * @access public
     * @param String $condition
     * @return Com_Database_Query 
     */
    public function orWhere($condition) {
        $this->lstConditions[] = array(
            'condition' => $condition
            , 'type' => 'OR'
        );
        return $this;
    }

    /**
     *
     * @access public
     * @param String $field
     * @return Com_Database_Query 
     */
    public function groupBy($field) {
        $this->lstGroup[] = $field;
        return $this;
    }

    /**
     *
     * @access public
     * @param String $field
     * @return Com_Database_Query 
     */
    public function orderBy($field) {
        $this->lstOrder[] = $field;
        return $this;
    }

    /**
     *
     * @access public 
     * @param Integer $begin
     * @param Integer $numberOfItems
     * @return Com_Database_Query 
     */
    public function limit($begin, $numberOfItems) {
        $this->begin = $begin;
        $this->numberOfItems = $numberOfItems;
        return $this;
    }

    /**
     *
     * @access public
     * @return String
     */
    public function __toString() {
        //Check Tables
        $tables = implode(",", $this->lstTables);
        //Check Links
        $links = "";
        foreach ($this->lstLinks as $intIndex => $lstLink) {
            $links.="{$lstLink['type']} {$lstLink['table']} ON ({$lstLink['link']}) ";
        }
        //conditions
        $conditions = "";
        foreach ($this->lstConditions as $intIndex => $lstCondition) {
            $conditions.= ( $lstCondition['type']) == "" ? "WHERE" : "";
            $conditions.=" {$lstCondition['type']} {$lstCondition['condition']}";
        }

        $groups = (count($this->lstGroup) > 0 ? ("GROUP BY " . implode(',', $this->lstGroup)) : "");
        $orders = (count($this->lstOrder) > 0 ? ("ORDER BY " . implode(',', $this->lstOrder)) : "");

        $lstFields = implode(",", $this->lstFields);
        return "SELECT {$lstFields} "
        . "FROM {$tables} "
        . " {$links}"
        . " {$conditions}"
        . " {$groups}"
        . " {$orders}"
        . " LIMIT {$this->begin},{$this->numberOfItems}";

        echo $lstFields;
    }

}