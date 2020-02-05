<?php
mysqli_report(MYSQLI_REPORT_STRICT);
// conncection file to mySQL
// Super Class or Main Class
class abstractDao{
    protected $mysqli;
    
     // Host address for the database 
    protected static $DB_HOST = "localhost";
    // Database username 
    protected static $DB_USERNAME = "cadt_hobby";
    // Database password 
    protected static $DB_PASSWORD = "password";
    // Name of database 
    protected static $DB_DATABASE = "CraftyActivityDevelopmentTeam";
    
    // function sends connection to mySQLi
    function __construct() {
        // try catch statement to handle exception for bad connection
        try{
            $this->mysqli = new mysqli(self::$DB_HOST, self::$DB_USERNAME, 
                self::$DB_PASSWORD, self::$DB_DATABASE);
        }catch(mysqli_sql_exception $e){
            throw  $e;
        }
    }
    
    public function getMysqli(){
        return $this->mysqli;   
    }
}

?>