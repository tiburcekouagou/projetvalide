<?php
namespace App\Controllers;

use App\Models\OrdersModel;

class AdminOrdersController extends OrdersModel{

    public static function selectAllOrders(){

        return parent::selectAllOrders();
       
    }

    public static function updateOrder(){

        if(isset($_POST['update_order'])){
        
           $order_id = $_POST['order_id'];
           $update_payment = $_POST['update_payment'];
           $update_payment = htmlspecialchars($update_payment);
       
          return parent::update_order($update_payment, $order_id);
        
        };
    }

    public static function deleteOrder(){

        if(isset($_GET['delete'])){
        
           $delete_id = $_GET['delete'];
           return parent::delete_order($delete_id);
        }
    }


    






}