<?php
namespace App\Controllers;
use App\Models\OrdersModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use App\Models\ContactModel;

class AdminHomeController {
    
    
    public static function selectPendings(){

        $model = new OrdersModel();

        $selectPendings = $model->selectPendings();
       
        return $selectPendings;

    }
    public static function selectCompleted(){
        
        $model = new OrdersModel();

        $selectCompleted = $model->selectCompleted();
        return $selectCompleted;

    }
    public static function numberOfOrders(){
        
        $model = new OrdersModel();

        $numberOfOrders = $model->numberOfOrders();
        return $numberOfOrders;

    }
    public static function numberOfProducts(){
        
        $model = new ProductModel();

        $numberOfProducts = $model->numberOfProducts();
        return $numberOfProducts;

    }
    public static function numberOfUsers(){
        
        $model = new UserModel();

        $numberOfUsers = $model->numberOfUsers();
        return $numberOfUsers;

    }
    public static function numberOfAdmins(){
        
        $model = new UserModel();

        $numberOfAdmins = $model->numberOfAdmins();
        return $numberOfAdmins;

    }
    public static function numberOfAccounts(){
        
        $model = new UserModel();

        $numberOfAccounts = $model->numberOfAccounts();
        return $numberOfAccounts;

    }
    public static function numberOfMessages(){
        
        $model = new ContactModel();

        $numberOfMessage = $model->numberOfMessages();
        return $numberOfMessage;

    }


}
       