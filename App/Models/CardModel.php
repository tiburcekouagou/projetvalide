<?php

namespace App\Models;
use Core\Connexion;
use App\Controllers\CardController;
use PDO;

class CardModel extends Connexion {
  

    public $connexion;

    public  static function check_cart_numbers($p_name, $user_id) {
        
        $conn = parent::connect();
        // session_start();
        $check_cart_numbers = $conn->prepare("SELECT * FROM `shop_db`.cart WHERE name = ? AND user_id = ?");
        $check_cart_numbers->execute([$p_name, $user_id]);

       return $check_cart_numbers;
        
    }

    public  static function count_cart_items() {
        
         $conn = parent::connect();
       
        // session_start()
        if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
         }else{
            $user_id = '';
         };
        
        $count_cart_items = $conn->prepare("SELECT * FROM `shop_db`.cart WHERE user_id = ?");
        $count_cart_items->execute([$user_id]);
        $result = $count_cart_items->rowcount();
        
        
       return $result;
        
    }

    public static function insertCard($user_id, $pid, $p_name, $p_price, $p_qty, $p_image){

        $conn = parent::connect();
        // session_start();
    
        $sql = "INSERT INTO `shop_db`.cart(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)";
        $insert_cart = $conn->prepare($sql);
        $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
       
    }

    public static function select_cart (){

        $conn = parent::connect();
        // session_start();
        $user_id = $_SESSION['user_id'];

        $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
        $select_cart->execute([$user_id]);
        $fetch_cart = $select_cart->fetchAll(PDO::FETCH_ASSOC);
        return $fetch_cart;
    }

    public static function delete_one_item ($delete_id){

         $conn = parent::connect();
        
        $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
        $delete_cart_item->execute([$delete_id]);
        
    }

    public static function delete_all_item ($user_id){

         $conn = parent::connect();
        
        $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
        $delete_cart_item->execute([$user_id]);
        
    }

    public static function update_qty ($p_qty, $cart_id){

         $conn = parent::connect();
        
        $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
        $update_qty->execute([$p_qty, $cart_id]);
       
        
    }


}