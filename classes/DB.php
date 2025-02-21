<?php

class DB{
    private static $db_name = 'roni4736_pasqua_ue2';
    private static $db_user = 'roni4736_pasqua';
    private static $db_password = '4I58ElYXLtI@lG';
    private static $db_host = 'aflokkat-projet.fr';
    private static $pdo;

    public static function getConnection(){
        if(self::$pdo===null){
            self::$pdo = new PDO("mysql:dbname=".self::$db_name.";host=".self::$db_host,self::$db_user,self::$db_password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
}