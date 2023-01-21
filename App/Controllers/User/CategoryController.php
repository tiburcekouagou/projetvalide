<?php
namespace App\Controllers;

use App\Models\CardModel;
use App\Models\WishlistModel;
use App\Controllers\CardController;
use App\Models\ProductModel;



class CategoryController {
      

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

                $category_name = $_GET['category'];

                switch ($category_name) {
                    case "hamburges":
                        header('location:/category?category=hamburges');
                        break;
                    case "a-cote":
                        header('location:/category?category=a-cote');
                        break;
                    case "desserts":
                        header('location:/category?category=desserts');
                        break;
                    default:
                        header('location:/category?category=boisson');
                    }

            }else{
                $addToWishlist =  new  WishlistModel();
                $check_wishlist_numbers = $addToWishlist->check_wishlist_numbers($p_name, $user_id);
                
                
                if($check_wishlist_numbers->rowCount() > 0){

                    $delete_wishlist = $addToWishlist->delete_wishlist($p_name, $user_id);
         
                }
                // session_start();

                $insert = $addToCard->insertCard($user_id, $pid, $p_name, $p_price, $p_qty, $p_image);
                $message[] = 'Un produit ajouté au panier!';

                $category_name = $_GET['category'];

                switch ($category_name) {
                    case "hamburges":
                        header('location:/category?category=hamburges');
                        break;
                    case "a-cote":
                        header('location:/category?category=a-cote');
                        break;
                    case "desserts":
                        header('location:/category?category=desserts');
                        break;
                    case "boisson":
                        header('location:/category?category=boissons');
                        break;
                    default:
                    header('location:/category?category=boissons');
                    }
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
            $category_name = $_GET['category'];

                switch ($category_name) {
                    case "hamburges":
                        header('location:/category?category=hamburges');
                        break;
                    case "a-cote":
                        header('location:/category?category=a-cote');
                        break;
                    case "desserts":
                        header('location:/category?category=desserts');
                        break;
                    case "boisson":
                        header('location:/category?category=boissons');
                        break;
                    default:
                    header('location:/category?category=boissons');
                       
                    }
        }
        
    }

    public static function getCategory($category_name){
       
        $result = ProductModel::getCategory($category_name);
       
        return $result;

    }

}

?>
