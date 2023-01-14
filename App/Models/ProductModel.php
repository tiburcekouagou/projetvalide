<?php

namespace App\Models;
use App\Controllers\Connexion;
use PDO;

class ProductModel extends Connexion {
  

    public $connexion;

    public  static function getOneProduct($pid) {

        $connexion = new Connexion ;
        $conn = $connexion->connect();
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $select_products->execute([$pid]);
        if($select_products->rowCount() > 0){
            $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
            return $fetch_products;
            
        }
    }

    public  static function getProduct() {

        $connexion = new Connexion ;
        $conn = $connexion->connect();
        $select_products = $conn->prepare("SELECT * FROM `shop_db`.products   ORDER BY `id` DESC LIMIT 6" );
        $select_products->execute();
        if($select_products->rowCount() > 0){
            $fetch_products = $select_products->fetchAll(PDO::FETCH_ASSOC);
            return $fetch_products;
            
        }
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
    }

    public static function searchProduct() {

        $connexion = new Connexion ;
        $conn = $connexion->connect();

        if(isset($_POST['search_btn'])){
            $search_box = $_POST['search_box'];
            $search_box = htmlspecialchars($search_box);
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$search_box}%' OR category LIKE '%{$search_box}%'");
            $select_products->execute();
        if($select_products->rowCount() > 0){
            $fetch_products = $select_products->fetchAll(PDO::FETCH_ASSOC);
            return $fetch_products;
            
        }
    }
}

}
