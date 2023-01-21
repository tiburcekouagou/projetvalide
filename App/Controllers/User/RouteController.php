<?php

namespace App\Controllers;

use \Core\View;


class RouteController extends \Core\Controller {
 
    public function homeAction() {
        
        View::render("home.php");
        
    }

    public function aboutAction() {
        
        View::render("about.php");
        
    }

    public function categoryAction() {
        
        View::render("category.php");
        
    }

    public function contactAction() {
    
        View::render("contact.php");
    }

    public function checkoutAction() {
    
        View::render("checkout.php");
    }

    public function ordersAction() {
    
        View::render("orders.php");
    }

    public function shopAction() {
    
        View::render("shop.php");
    }


    public function loginAction() {
    
        View::render("login.php");
    }

    public function cardAction() {
    
        View::render("card.php");
    }
    
    public function registerAction() {
    
        View::render("register.php");
    }

    public function logoutAction() {

        session_start();
        session_unset();
        session_destroy();

        View::render("home.php");
    }
    
    public function searchAction() {
    
        View::render("search_page.php");
    }
    
    public function updateAction() {
    
        View::render("user_profile_update.php");
    }

    public function viewsAction() {
    
        View::render("view_page.php");
    }

    public function wishlistAction() {
    
        View::render("wishlist.php");
    }

  
}
