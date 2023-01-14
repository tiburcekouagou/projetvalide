<?php
namespace App\Controllers;

use App\Models\CardModel;
use App\Models\OrdersModel;

class CheckoutController{

    public static function checkoutAction(){
        session_start();

        if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
        }else{
            $user_id = '';
            header('location:/');
        };
         
         
        if(isset($_POST['order'])){
            $user_id = $_SESSION['user_id'];
            
        if(!isset($user_id)){
               header('location:/login');
            };
         
            $name = $_POST['name'];
            $name = htmlspecialchars($name);
            $number = $_POST['number'];
            $number = htmlspecialchars($number);
            $email = $_POST['email'];
            $email = htmlspecialchars($email);
            $method = $_POST['method'];
            $method = htmlspecialchars($method);
            $address = 'Appartement n°. '. $_POST['flat'] .' '. $_POST['street'] .' '. $_POST['city'] .' '. $_POST['state'] .' '. $_POST['country'] .' - '. $_POST['pin_code'];
            $address = htmlspecialchars($address);
            $placed_on = date('d-M-Y');
         
            $cart_total = 0;
            $cart_products[] = '';

            $count_cart_items = CardModel::select_cart ();
         
        
            if(isset($count_cart_items) && count($count_cart_items) > 0){
              foreach ($count_cart_items as $key => $value) {
                $cart_products[] = $value['name'].' ( '.$value['quantity'].' )';
                $sub_total = ($value['price'] * $value['quantity']);
                $cart_total += $sub_total;
              
              }
            };
         
            $total_products = implode(', ', $cart_products);
         
            $order = OrdersModel::orders($name, $number, $email, $method, $address, $total_products, $cart_total);
         
            if($cart_total == 0){
               $message[] = 'your cart is empty';
            }elseif( $order > 0){
               $message[] = 'Commande déjà passée!';
            }else{
               $insertOrder = OrdersModel::insertOrders($user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on);

               $delete_cart = CardModel::delete_all_item ($user_id);

               $message[] = 'Commande passée avec succès !';
            }
         
        }

    }




}
