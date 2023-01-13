<?php
namespace App\Controllers;

class Connexion {
    public function connect() {
        /**
         * $DB_HOST 
         */
        $DB_HOST = "localhost";
        /**
         * $DB_NAME
         */
        $DB_NAME = "shop_db";
        /**
         * $USERNAME
         */
        $USERNAME = "root";
        /**
         * $PASSWORD
         */
        $PASSWORD = "";
        $dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4";
        try {
            /**
             * 
             */
            $connection = new \PDO($dsn, $USERNAME, $PASSWORD);
        
            return $connection;
            
        } catch(PDOException $e) {
            die('Erreur de connexion à la base de donnée:'.$e->getMessage());
        }
    }
}