<?php
class Database {
    private static $host;
    private static $dbname;
    private static $username;
    private static $password;
    private static $dsn;
    private static $db;

    public function __construct(){
        self::$host = getenv('SQL_HOST') ? getenv('SQL_HOST') : 'r4wkv4apxn9btls2.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
        self::$dbname = getenv('SQL_DB') ? getenv('SQL_DB') : 'ywjy0umm9qs73g4a';
        self::$username = getenv('SQL_USER') ? getenv('SQL_USER') : 'vmsd6aewymsxzdgi';
        self::$password = getenv('SQL_PW') ? getenv('SQL_PW') : 'zj6g5dris9kla3zv';
        self::$dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$dbname;
    }

    public static function getDB() {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn,
                                    self::$username,
                                    self::$password);
            } catch (PDOException $e) {
                $error_message = 'Database Error: ';
                $error_message .= $e->getMessage();
                include('view/error.php');
                exit();
            }
        }
        return self::$db;
    }
}

// Create new database object since static properties are set at compile time
// static variables may only be initialized using literal or constant (PHP <5.6)
// Limited expressions are possible if they can be evaluated at compile time (PHP >= 5.6)
$database = new Database();
?>
