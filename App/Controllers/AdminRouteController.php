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
        
        View::render("admin_orders.php");
        
    }

    public function admin_contactsAction() {
    
        View::render("admin_contacts.php");
    }

    public function update_profileAction() {
    
        View::render("admin_update_profile.php");
    }

    public function update_productAction() {
    
        View::render("admin_update_product.php");
    }

    public function admin_usersAction() {
    
        View::render("admin_users.php");
    }



    public function logoutAction() {

        session_start();
        session_unset();
        session_destroy();

        View::render("home.php");
    }
    

  
}
