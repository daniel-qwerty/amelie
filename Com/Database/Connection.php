<?php


class Com_Database_Connection extends Com_Object
{

    /**
     * Mysql database server ip or name
     * @access private
     * @var String
     */
    private $server = DATABASE_SERVER;
    /**
     * Mysql connection port
     * @access private
     * @var Integer
     */
    private $port = DATABASE_PORT;
    /**
     * Mysql database name
     * @access private
     * @var String
     */
    private $database = DATABASE_NAME;
    /**
     * Mysql database username
     * @access private
     * @var String
     */
    private $username = DATABASE_USERNAME;
    /**
     * Mysql database user password
     * @access private
     * @var String
     */
    private $password = DATABASE_PASSWORD;
    /**
     * Mysql database connection link LinkIdentifier
     * @access private
     * @var Integer
     */
    private $databaseLink;
    /**
     * Mysql resulset ResourceId
     * @access private
     * @var Integer
     */
    private $resulset;
    /**
     * Mysql Affected Rows
     * @access private
     * @var Integer
     */
    private $affectedRegistries = 0;

    /**
     *
     * @return Com_Database_Connection
     */
    public static function getInstance()
    {
        return self::_getInstance(__CLASS__);
    }

    public function __construct()
    {
        


        $this->databaseLink = mysqli_connect($this->server, $this->username, $this->password, $this->database);
       
      
        if (!mysqli_select_db($this->databaseLink, $this->database)) {
            throw new Com_Debug_Exception("DataBase Connection Error", "101");
        }
    }

    /**
     *
     * Start a mysql Transaction
     * @access public
     */
    public function openTransaction()
    {
        mysqli_query($this->databaseLink, "SET autocommit=0;
                     START TRANSACTION;" );
    }

    /**
     *
     * Execute a transaction
     * @access public
     */
    public function commitTransaction()
    {
        mysqli_query( $this->databaseLink,"COMMIT;");
    }

    /**
     *
     * Rollback a transaction thread
     * @access public
     */
    public function rollbackTransaction()
    {
        mysqli_query($this->databaseLink,"ROLLBACK;");
    }

    /**
     *
     * Execute a sql script
     * @access public
     * @param String $sqlQuery
     * @return Boolean
     */
    public function execute($sqlQuery)
    {
        $this->resulset = mysqli_query( $this->databaseLink,"{$sqlQuery};");
        $this->affectedRegistries = @mysqli_affected_rows($this->databaseLink);
        $this->affectedRegistries = $this->affectedRegistries > 0 ? $this->affectedRegistries : "";
        if ($this->affectedRegistries == "") {
            $this->affectedRegistries = @mysqli_num_rows($this->resulset);
        }
        return ($this->affectedRegistries > 0);
    }

    /**
     *
     * @access public
     * @return Integer
     */
    public function getLastId()
    {
        return mysqli_insert_id($this->databaseLink);
    }

    /**
     *
     * Return a row object
     * @access public
     * @return Object
     */
    public function getObject()
    {
        return mysqli_fetch_object($this->resulset);
    }

    /**
     *
     * Return a row array
     * @access public
     * @return Array
     */
    public function getArray()
    {
        return mysqli_fetch_array($this->resulset);
    }

    /**
     *
     * Return a row association array
     * @access public
     * @return Array
     */
    public function getAssociation()
    {
        return mysqli_fetch_assoc($this->resulset);
    }

    /**
     *
     * Close a mysql connection and free a mysql resultset
     * @access public
     */
    public function close()
    {
        mysqli_free_result($this->resulset);
        mysqli_close($this->databaseLink);
    }

    /**
     *
     * Return number of affected registries
     * @access public
     * @return Integer
     */
    public function getNumberRegistries()
    {
        return $this->affectedRegistries;
    }

    /**
     *
     * Return number of columns from the resulset
     * @access public
     * @return Integer
     */
    public function getNumberColumns()
    {
        return mysqli_num_fields($this->resulset);
    }

}