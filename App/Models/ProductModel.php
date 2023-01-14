<?php

namespace App\Models;
use App\Controllers\Connexion;
use PDO;

class ProductModel extends Connexion {
  

    public $connexion;

    public  static function getProduct() {

        $connexion = new Connexion ;
        $conn = $connexion->connect();
        $select_products = $conn->prepare("SELECT * FROM `shop_db`.products   ORDER BY `id` DESC LIMIT 6" );
        $select_products->execute();
        if($select_products->rowCount() > 0){
            $fetch_products = $select_products->fetchAll(PDO::FETCH_ASSOC);
            return $fetch_products;
            
        }
    
        return 'Aucune donnée récupérer';
    }

    public  static function getAllProduct() {

        $connexion = new Connexion ;
        $conn = $connexion->connect();

        $select_products = $conn->prepare("SELECT * FROM `shop_db`.products ORDER BY `id` DESC");
        $select_products->execute();
        if($select_products->rowCount() > 0){
            $fetch_products = $select_products->fetchAll(PDO::FETCH_ASSOC);
            return $fetch_products;
            
        }
    
        return 'Aucune donnée récupérer';
    }

    public static function getCategory($category_name) {

        $connexion = new Connexion ;
        $conn = $connexion->connect();

        $select_products = $conn->prepare("SELECT * FROM `products` WHERE category = ?");
        $select_products->execute([$category_name]);
        if($select_products->rowCount() > 0){
            $fetch_products = $select_products->fetchAll(PDO::FETCH_ASSOC);
            return $fetch_products;
            
        }
    
        return 'Aucune donnée récupérer';
    }
}


