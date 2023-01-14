<?php
namespace App\Controllers;

use App\Models\OrdersModel;

class OrdersController{

    public static function getOrders(){
        
        $user_id = $_SESSION['user_id'];
       
        if(!isset($user_id)){
        header('location:/login');
        }


        $fecth_orders = OrdersModel::getOrders($user_id);
        return $fecth_orders;
    }
}
