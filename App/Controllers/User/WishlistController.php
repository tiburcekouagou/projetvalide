<?php
namespace  App\Controllers;
use  App\Models\WishlistModel;
use  App\Models\CardModel;

/**
 * 
 */
class WishlistController {

    /**
     * $conn
     */
    public $connexion;
    public $pid;
    public $p_name;
    public $p_image;
    public $p_qty;


    public static function infoWishlist(){
        

        if(isset($_POST['add_to_cart'])){

            $user_id = $_SESSION['user_id'];
            if(!isset($user_id)){
                  header('location:/login');
            }
         
            $pid = htmlspecialchars($_POST['pid']);
            $p_name = htmlspecialchars($_POST['p_name']);
            $p_price = htmlspecialchars($_POST['p_price']);
            $p_image = htmlspecialchars($_POST['p_image']);
            $p_qty = htmlspecialchars($_POST['p_qty']);


            $_SESSION['pid'] =  $pid;
            $_SESSION['p_name'] =  $p_name;
            $_SESSION['p_price'] =  $p_price;
            $_SESSION['_image'] =  $p_image;
            $_SESSION['p_qty'] =  $p_qty;

            header('location:/');
        }

    }


    public static function count_wishlist_items(){

        $count_wishlist_items = WishlistModel::count_wishlist_items();
        
        return $count_wishlist_items;

        if ($count_wishlist_items === false) {
            return 'Aucune donnée recupérer';
        }

    }

    public static function addToWishlist (){

        $addToCard = CardModel::insert_cart();
        return $addToCard;

    }


    public static function returnWishlist() {
        // session_start();
        if(isset($_SESSION['user_id'])){
           $user_id = $_SESSION['user_id'];
        }else{
           $user_id = '';
        };
       
        $showWishlish = WishlistModel::showWishlist($user_id);
        return $showWishlish;
    }

    public static function wishAction() {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
         }
         
         $user_id = $_SESSION['user_id'];
         
         
         
         if(!isset($user_id)){
            header('location:/login');
         }
        
        
        if(isset($_POST['add_to_cart'])){
        
           $pid = $_POST['pid'];
           $pid = htmlspecialchars($pid);
           $p_name = $_POST['p_name'];
           $p_name = htmlspecialchars($p_name);
           $p_price = $_POST['p_price'];
           $p_price = htmlspecialchars($p_price);
           $p_image = $_POST['p_image'];
           $p_image = htmlspecialchars($p_image);
           $p_qty = $_POST['p_qty'];
           $p_qty = htmlspecialchars($p_qty);
        
        
           $addToCard =  new  CardModel(); 

            $check_cart_numbers = $addToCard->check_cart_numbers($p_name, $user_id);;
        
           if($check_cart_numbers->rowCount() > 0){
              $message[] = 'Déja ajouter au panier!';
           }else{
        
                $addToWishlist =  new  WishlistModel();
                $check_wishlist_numbers = $addToWishlist->check_wishlist_numbers($p_name, $user_id);
                
        
              if($check_wishlist_numbers->rowCount() > 0){
                $delete_wishlist = $addToWishlist->delete_wishlist($p_name, $user_id);
              }
        
              $insert = $addToCard->insertCard($user_id, $pid, $p_name, $p_price, $p_qty, $p_image);
                $message[] = 'Un produit ajouté au panier! !';
           }
        
        }

        if(isset($_GET['delete'])){
            $delete_id = $_GET['delete'];
            $delete_one_item = new WishlistModel();
            $delete = $delete_one_item->delete_one_item ($delete_id);
        
           header('location:/wishlist');

         }
         
         if(isset($_GET['delete_all'])){
            $delete_all_item = new WishlistModel();
            $delete = $delete_all_item->delete_all_item ($user_id);
           
            header('location:/wishlist');
        }
        
        
    }

}

?>