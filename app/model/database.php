<?php
class Database{
    
    public $conn = null;
    static private $host = "localhost";
    static private $username = "root";
    static private $password = "";
    static private $databaseName = "sage";
    private $stmt = null;

    public function __construct(){
       $this->conn = $this->connect();
    }

    static public function connect(){
        $inline_conn = null;
        try {
            $inline_conn = new PDO(
                "mysql:host=".self::$host.";dbname=".self::$databaseName.";charset=utf8",
                self::$username,
                self::$password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
            $inline_conn->exec("SET character_set_client='utf8'");
            $inline_conn->exec("SET character_set_results='utf8'");
            $inline_conn->exec("SET collation_connection='utf8_general_ci'");
            $inline_conn->exec("SET time_zone = 'Asia/Kuala_Lumpur'");
            return $inline_conn;
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    function __destruct(){
        if ($this->stmt !== null) {
            $this->stmt = null;
        }
        if ($this->conn !== null) {
            $this->conn = null;
        }
    }
}
?>