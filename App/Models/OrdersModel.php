<?php
namespace App\Models;
use App\Controllers\Connexion;


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


}

