<?php

namespace App\Controllers;
use  App\Models\CardModel;
use  App\Models\WishlistModel;
use App\Models\ProductModel;


class ProductController {

    public $getting;

    public static function getOneProduct($pid){

        
        return $getting = ProductModel::getOneProduct($pid);
        
        if ($getting === false) {
            echo 'Aucune donnée recupérer';
        }
      
    }

    public static function getProduct(){

        
        return $getting = ProductModel::getProduct();
        
        if ($getting === false) {
            echo 'Aucune donnée recupérer';
        }
      
    }

    public static function getAllProduct(){

        
        return $getting = ProductModel::getAllProduct();

        if ($getting === false) {
            echo 'Aucune donnée recupérer';
        }
      
    }

    public static function searchProduct(){

        
        return $getting = ProductModel::searchProduct();

        if ($getting === false) {
            echo 'Aucune donnée recupérer';
        }
      
    }

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

                header('location:/shop');
            }else{
                $addToWishlist =  new  WishlistModel();
                $check_wishlist_numbers = $addToWishlist->check_wishlist_numbers($p_name, $user_id);
                
                
                if($check_wishlist_numbers->rowCount() > 0){

                    $delete_wishlist = $addToWishlist->delete_wishlist($p_name, $user_id);
         
                }
                // session_start();

                $insert = $addToCard->insertCard($user_id, $pid, $p_name, $p_price, $p_qty, $p_image);
                $message[] = 'Un produit ajouté au panier!';

                header('location:/shop');
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
            header('location:/shop');
        }
        
    }

}