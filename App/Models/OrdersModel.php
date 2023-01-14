<?php
namespace App\Models;
use App\Controllers\Connexion;
use PDO;


class OrdersModel{

    public static function getOrders($user_id){

        $connexion = new Connexion();
        $conn = $connexion->connect();

        $select_orders = $conn->prepare("SELECT * FROM `shop_db`.orders WHERE user_id = ?");
        $select_orders->execute([$user_id]);

        if ($select_orders->rowCount() > 0) {
            $fetch_orders = $select_orders->fetchAll(PDO::FETCH_ASSOC);
            return $fetch_orders;
        }
    } 

    public static function orders($name, $number, $email, $method, $address, $total_products, $cart_total){

        $connexion = new Connexion();
        $conn = $connexion->connect();

        $order_query = $conn->prepare("SELECT * FROM `orders` WHERE name = ? AND number = ? AND email = ? AND method = ? AND address = ? AND total_products = ? AND total_price = ?");
        $order_query->execute([$name, $number, $email, $method, $address, $total_products, $cart_total]);
        $result = $order_query->rowCount();
        return $result;
    } 

    public static function insertOrders($user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on){

        $connexion = new Connexion();
        $conn = $connexion->connect();

        $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES(?,?,?,?,?,?,?,?,?)");
        $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on]);
     
    } 


}

