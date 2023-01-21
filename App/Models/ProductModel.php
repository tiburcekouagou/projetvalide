<?php

namespace App\Models;
use Core\Connexion;
use PDO;

class ProductModel extends Connexion {
  

    public $connexion;

    public  static function getOneProduct($pid) {

        $conn = parent::connect();

        $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $select_products->execute([$pid]);
        if($select_products->rowCount() > 0){
            $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
        
            return $fetch_products;
            
        }
        return  'AUcune donné récuperer';
    }

    public  static function getProduct() {

         $conn = parent::connect();

        $select_products = $conn->prepare("SELECT * FROM `shop_db`.products   ORDER BY `id` DESC LIMIT 6" );
        $select_products->execute();
        if($select_products->rowCount() > 0){
            $fetch_products = $select_products->fetchAll(PDO::FETCH_ASSOC);
            return $fetch_products;
            
        }
    }

    public  static function getAllProduct() {

         $conn = parent::connect();

        $select_products = $conn->prepare("SELECT * FROM `shop_db`.products ORDER BY `id` DESC");
        $select_products->execute();
        if($select_products->rowCount() > 0){
            $fetch_products = $select_products->fetchAll(PDO::FETCH_ASSOC);
            return $fetch_products;
            
        }
    }

    public static function getCategory($category_name) {

        $conn = parent::connect();

        $select_products = $conn->prepare("SELECT * FROM `products` WHERE category = ?");
        $select_products->execute([$category_name]);
        if($select_products->rowCount() > 0){
            $fetch_products = $select_products->fetchAll(PDO::FETCH_ASSOC);
            return $fetch_products;
            
        }
    }

    public static function searchProduct() {

        $conn = parent::connect();

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

    public function numberOfProducts(){

        $conn = parent::connect();

        $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         $number_of_products = $select_products->rowCount();
         return $number_of_products;
    }

    public static function selectProducts($name){

        $conn = parent::connect();

        $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
        $select_products->execute([$name]);
        $result = $select_products->rowCount();
         
        return $result;
    }

    public static function insertProducts($name, $category, $details, $price, $image){

        $conn = parent::connect();

        $insert_products = $conn->prepare("INSERT INTO `products`(name, category, details, price, image) VALUES(?,?,?,?,?)");
        $insert_products->execute([$name, $category, $details, $price, $image]);

    }

    public static function selectImage($delete_id){

        $conn = parent::connect();

        $select_delete_image = $conn->prepare("SELECT image FROM `products` WHERE id = ?");
        $select_delete_image->execute([$delete_id]);
        $fetch_delete_image = $select_delete_image->fetch(PDO::FETCH_ASSOC);
        return $fetch_delete_image;

    }

    public static function deleteAll($delete_id){

        $conn = parent::connect();

        $delete_products = $conn->prepare("DELETE FROM `products` WHERE id = ?");
        $delete_products->execute([$delete_id]);
        
        $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
        $delete_wishlist->execute([$delete_id]);

        $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
        $delete_cart->execute([$delete_id]);

    }

    public static function updateProduct($name, $category, $details, $price, $image, $id){

        $conn = parent::connect();

        $updateProduct = $conn->prepare( "UPDATE `products` SET name = ?, category = ?, details = ?, price = ?, image = ? WHERE `products`.id = ? ;");
        $updateProduct->execute([
            $name, 
            $category, 
            $details, 
            $price, 
            $image, 
            $id 
        ]);

    } 

}

