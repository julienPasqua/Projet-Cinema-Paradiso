<?php

class DB{
    private static $db_name = 'cinema_paradiso';
    private static $db_user = 'root';
    private static $db_password = 'root';
    private static $db_host = 'localhost';
    private static $pdo;

    public static function getConnection(){
        if(self::$pdo===null){
            self::$pdo = new PDO("mysql:dbname=".self::$db_name.";host=".self::$db_host,self::$db_user,self::$db_password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
}