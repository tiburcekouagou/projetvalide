<?php

namespace App\Models;
use Core\Connexion;

use PDO;

class WishlistModel extends Connexion {
  

   

    public  static function count_wishlist_items() {
        
        $conn = parent::connect();
        
        if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
         }else{
            $user_id = '';
         };

        $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
        $count_wishlist_items->execute([$user_id]);
        $result = $count_wishlist_items->rowCount();
       
       return $result;
        
    }

    public static function insertWishlist($user_id, $pid, $p_name, $p_price, $p_qty, $p_image){

        $conn = parent::connect();
      
        $sql = "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)";
        $insert_cart = $conn->prepare($sql);
        $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
       
    }

    public  static function check_wishlist_numbers($p_name, $user_id) {
        
        $conn = parent::connect();
  
        $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
        $check_wishlist_numbers->execute([$p_name, $user_id]);

       return $check_wishlist_numbers;
        
    }

    public  static function delete_wishlist($p_name, $user_id) {
        
        $conn = parent::connect();

        $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
        $delete_wishlist->execute([$p_name, $user_id]);

       return $delete_wishlist;
        
    }

    public static function showWishlist($user_id){

        $conn = parent::connect();
       
        $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
        $select_wishlist->execute([$user_id]);
        $result = $select_wishlist->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function delete_one_item ($delete_id){

         $conn = parent::connect();
        
        $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE id = ?");
        $delete_wishlist_item->execute([$delete_id]);
        
    }

    public static function delete_all_item ($user_id){

        $conn = parent::connect();
        
        $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
        $delete_wishlist_item->execute([$user_id]);
        
    }



   
}



