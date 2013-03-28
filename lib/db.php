<?php
 
class Db
{
    private static $db;
     
    public static function init()
    {
        if (!self::$db)
        {
            try {
                 $dsn = 'mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME;
                self::$db = new PDO($dsn, DB_USER, DB_PASS);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // Normally, we would log this
                die('Connection error: ' . $e->getMessage() . '
');
            }
        }
        return self::$db;
    }
}