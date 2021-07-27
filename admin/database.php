<?php 

class Database{
private static $dbHost ="localhost";
private static $dbName = "burger_shop";
private static $userName = "root";
private static $userPass = "";
private static $connection = null;

    public static function connect(){
        try{
            self::$connection = new PDO("mysql:host=".self::$dbHost .";dbname=".self::$dbName,self::$userName,self::$userPass);
        }catch(PDOException $e){
            die($e->getMessage());
        }
        return self::$connection;
    }

   public static function disconnect(){
        self::$connection = null;
    }

}
Database::connect();



?>
