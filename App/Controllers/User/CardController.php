<?php
namespace  App\Controllers;
use  App\Models\CardModel;
use  App\Models\WishlistModel;


class CardController {

    
    
    public static function add(){
        
        
        if(isset($_POST['add_to_cart'])){
            session_start();


            if(isset($_SESSION['user_id'])){
                $user_id = $_SESSION['user_id'];
             }
           
            if(!isset($user_id)){
                  header('location:/login');
            }
         
            $pid = htmlspecialchars($_POST['pid']);
            $p_name = htmlspecialchars($_POST['p_name']);
            $p_price = htmlspecialchars($_POST['p_price']);
            $p_image = htmlspecialchars($_POST['p_image']);
            $p_qty = htmlspecialchars($_POST['p_qty']);

            $addToCard =  new  CardModel(); 

            $check_cart_numbers = $addToCard->check_cart_numbers($p_name, $user_id);
            
            if($check_cart_numbers->rowCount() > 0){
                $message[] = 'Déjà ajouté au panier !';

                header('location:/');
            }else{
                $addToWishlist =  new  WishlistModel();
                $check_wishlist_numbers = $addToWishlist->check_wishlist_numbers($p_name, $user_id);
                
                
                if($check_wishlist_numbers->rowCount() > 0){

                    $delete_wishlist = $addToWishlist->delete_wishlist($p_name, $user_id);
         
                }
                // session_start();

                $insert = $addToCard->insertCard($user_id, $pid, $p_name, $p_price, $p_qty, $p_image);
                $message[] = 'Un produit ajouté au panier!';

                header('location:/');
            }
        }


        if(isset($_POST['add_to_wishlist'])){

            session_start();

            if(isset($_SESSION['user_id'])){
                $user_id = $_SESSION['user_id'];
             }
           
            if(!isset($user_id)){
                header('location:/login');
            }
         
            $pid = htmlspecialchars($_POST['pid']);
            $p_name = htmlspecialchars($_POST['p_name']);
            $p_price = htmlspecialchars($_POST['p_price']);
            $p_image = htmlspecialchars($_POST['p_image']);
            $p_qty = htmlspecialchars($_POST['p_qty']);

            
            $addToWishlist =  new  WishlistModel();
            $check_wishlist_numbers = $addToWishlist->check_wishlist_numbers($p_name, $user_id);
         
            $addToCard =  new  CardModel(); 
            $check_cart_numbers = $addToCard->check_cart_numbers($p_name, $user_id);
         
            if($check_wishlist_numbers->rowCount() > 0){
               $message[] = 'Déjà ajouté à la liste de souhaits !';
            }elseif($check_cart_numbers->rowCount() > 0){
               $message[] = 'Déjà ajouté au panier !';
            }else{
                $insert = $addToWishlist->insertWishlist($user_id, $pid, $p_name, $p_price, $p_qty, $p_image);
                $message[] = 'Ajouté à la liste de souhaits !';
            }
            header('location:/');
        }
        
    }


    public static function count_cart_items(){

        $count_cart_items = CardModel::count_cart_items();
        
        return $count_cart_items;

        if ($count_cart_items === false) {
            return 'Aucune donnée recupérer';
        }

    }
    
    public static function select_cart(){

        $select_cart = CardModel::select_cart();
        
        return $select_cart;

        if ($select_cart === false) {
            return 'Aucune donnée recupérer';
        }

    }

    public static function cardAction(){
        // session_start();

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
         }
         
            $user_id = $_SESSION['user_id'];
            
         
         
         if(!isset($user_id)){
            header('location:/login');
         }

         
        
         
         if(isset($_GET['delete'])){
            $delete_id = $_GET['delete'];
            $delete_one_item = new CardModel();
            $delete = $delete_one_item->delete_one_item ($delete_id);
        
            header('location:/card');
         }
         
         if(isset($_GET['delete_all'])){
            $delete_all_item = new CardModel();
            $delete = $delete_all_item->delete_all_item ($user_id);
           
            header('location:/card');
        }
        
        if(isset($_POST['update_qty'])){
            $cart_id = $_POST['cart_id'];
            $p_qty = $_POST['p_qty'];
            $p_qty = htmlspecialchars($p_qty);

            $update_item = new CardModel();
            $update = $update_item->update_qty ($p_qty, $cart_id);
          
            $message[] = 'Quantité du panier mise à jour';
         }
    }


}

?>