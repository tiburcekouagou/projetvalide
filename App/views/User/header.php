<?php
  use App\Controllers\Connexion;
  use App\Controllers\CardController;
  use App\Controllers\WishlistController;
  
  if (session_status() == PHP_SESSION_NONE) {
   session_start();
  }

?>




<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">Big<span>Burger+</span></a>

      <nav class="navbar">
         <a href="/">Accueil</a>
         <a href="/shop">Boutique</a>
         <a href="/orders">Commande</a>
         <a href="/about">A-propos</a>
         <a href="/contact">Contact</a>
      </nav>

      <div class="icons"  >
         <div id="menu-btn"  class="fas fa-bars" ></div>
         <div id="user-btn"  class="fas fa-user">
            <!-- user -->

         </div>
         <a href="/search" ><i class="fas fa-search"></i>
         <!-- search -->
      </a>
         <?php

            $count_wishlist_items = WishlistController::count_wishlist_items();
            $count_cart_items = CardController::count_cart_items();

         ?>
         <a href="/wishlist" class='wishlist'>
            <!-- Love -->
            <i class="fas fa-heart"></i>
            <span><?= $count_wishlist_items; ?></span>
         </a>
         <a href="/card" class='card'>
            <!-- Card -->
            <i class="fas fa-shopping-cart"></i>
            <span><?= $count_cart_items; ?></span>
         </a>
      </div>

      <div class="profile">

         <?php if (isset($_SESSION['user_id'])): ?>
               <img src="./ressources/pictures_users/<?= $_SESSION['user_image']; ?>" alt="">
               <p><?= $_SESSION['user_name']; ?> (<?= $_SESSION['role']; ?>)</p>
               <?php if (isset($_SESSION['admin_id'])):?>
                  <a href="/admin_home" class="option-btn">Dashboard</a>
               <?php endif;?>
               
               <a href="/update" class="btn">Mise à jour/ Profile</a>
               <a href="/logout" class="delete-btn">Se déconnecter</a>

         
         <?php else: ?>
            <p class="flex-btn">Connectez-vous pour une meilleure expérience! 😋</p>
            <a href="/login" class="option-btn">Se connecter</a>
         <?php endif; ?>
      </div>

   </div>

</header>