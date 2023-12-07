<?php
class DBConnection {

    public static function getConnection(){
        try{
            $db = new PDO("mysql:dbname=sistema_de_estoque;host:localhost","root","");
            return $db;
        }catch(PDOException $e){
            
        }
    }    

}
?>
