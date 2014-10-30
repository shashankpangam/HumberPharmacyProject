<?php
class Databases
{
    private static $constring = 'mysql:host=104.131.75.50;dbname=humberpharmacy';
    private static $username = 'root';
    private static $password = 'shashankpangam';
    
    private static $db;
    
    private function __construct() {}
    
    public static function connectDB () {
    	
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$constring,
                                     self::$username,
                                     self::$password);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                include('../Errors/database_error.php');
                exit();
            }
        }
        return self::$db;
    }
}
?>

