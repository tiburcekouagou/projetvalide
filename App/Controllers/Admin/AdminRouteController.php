<?php

namespace App\Controllers;

use \Core\View;


class AdminRouteController extends \Core\Controller {
 
    public function admin_homeAction() {
        
        View::render("admin_page.php");
        
    }

    public function admin_productsAction() {
        
        View::render("admin_products.php");
        
    }

    public function admin_ordersAction() {
        session_start();

        if ($_SESSION['role'] !== 'admin' ) {
            header('Location:/');
        }

        AdminOrdersController::updateOrder();
        AdminOrdersController::deleteOrder();
        $fetch_orders = AdminOrdersController::selectAllOrders();
        
        View::render("admin_orders.php", ['fetch_orders'=>$fetch_orders]);
        
    }

    public function admin_contactsAction() {
        AdminMessageController::deleteMessage();
        $fetch_message = AdminMessageController::selectAllMessage();
    
        View::render("admin_contacts.php", ['fetch_message'=>$fetch_message]);
    }

    public function update_profileAction() {
    
        View::render("admin_update_profile.php");
    }

    public function update_productAction() {
    
        $fetch_product = AdminUpdateProductController::getOneProduct();
        View::render("admin_update_product.php",["fetch_product"=>$fetch_product]);
    }

    public function admin_usersAction() {
        session_start();

        if ($_SESSION['role'] !== 'admin' ) {
            header('Location:/');
        }

        $fetch_users = AdminUserController::selectAllUsers();
    
        View::render("admin_users.php", ["fetch_users"=>$fetch_users]);
    }



    public function logoutAction() {

        session_start();
        session_unset();
        session_destroy();

        View::render("home.php");
    }
    

  
}
