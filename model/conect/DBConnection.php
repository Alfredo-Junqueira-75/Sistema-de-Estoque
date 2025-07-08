<?php

class DBConnection {
    private static $db;

    private function __construct() {}

    public static function getConnection() {
        if (!self::$db) {
            try {
                self::$db = new PDO("mysql:host=localhost;dbname=sistema_de_estoque", "root", "root");
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }

        return self::$db;
    }
}
?>
