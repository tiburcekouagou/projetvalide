<?php
namespace App\Models;
use Core\Connexion;
use PDO;


class OrdersModel extends Connexion{

    public static function getOrders($user_id){

        $conn = parent::connect();

        $select_orders = $conn->prepare("SELECT * FROM `shop_db`.orders WHERE user_id = ?");
        $select_orders->execute([$user_id]);

        if ($select_orders->rowCount() > 0) {
            $fetch_orders = $select_orders->fetchAll(PDO::FETCH_ASSOC);
            return $fetch_orders;
        }
    } 

    public static function orders($name, $number, $email, $method, $address, $total_products, $cart_total){

        $conn = parent::connect();

        $order_query = $conn->prepare("SELECT * FROM `orders` WHERE name = ? AND number = ? AND email = ? AND method = ? AND address = ? AND total_products = ? AND total_price = ?");
        $order_query->execute([$name, $number, $email, $method, $address, $total_products, $cart_total]);
        $result = $order_query->rowCount();
        return $result;
    } 

    public static function insertOrders($user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on){

        $conn = parent::connect();

        $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES(?,?,?,?,?,?,?,?,?)");
        $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on]);
     
    } 
    public static function selectCompleted(){

        $conn = parent::connect();

        $select_completed = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
        $select_completed->execute(['Effectuer']);
        if ($select_completed->rowCount() > 0) {
            $fetch_completed = $select_completed->fetchAll(PDO::FETCH_ASSOC);
            return $fetch_completed;
        }
     
    } 
    public static function selectPendings(){

        $conn = parent::connect();

        $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
        $select_pendings->execute(['En attente']);
        if ($select_pendings->rowCount() > 0) {
            $fetch_pendings = $select_pendings->fetchAll(PDO::FETCH_ASSOC);
            return $fetch_pendings;
        }
     
    } 

    public static function selectAllOrders(){

        $conn = parent::connect();

        $select_orders = $conn->prepare("SELECT * FROM `orders` ");
        $select_orders->execute();
        if ($select_orders->rowCount() > 0) {
            $fetch_orders = $select_orders->fetchAll(PDO::FETCH_ASSOC);
            return $fetch_orders;
        }
     
    } 

    public static function numberOfOrders(){

        $conn = parent::connect();

        $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         $number_of_orders = $select_orders->rowCount();
         return  $number_of_orders;
     
    } 

    public static function update_order($update_payment, $order_id){

        $conn = parent::connect();
   
        $update_orders = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
        $update_orders->execute([$update_payment, $order_id]);
    }
    

    public static function delete_order($delete_id){

        $conn = parent::connect();
   
        $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
        $delete_orders->execute([$delete_id]);
    }


}

