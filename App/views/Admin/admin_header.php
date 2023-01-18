<?php
if (session_status() == PHP_SESSION_NONE) {
   session_start();
}

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>

<header class="header">

   <div class="flex">

      <a href="/admin_home" class="logo"> Administration<span>+</span></a>

      <nav class="navbar">
         <ul style="display:flex; list-style: none;">
            <li> <a href="/admin_home">Dashboard</a></li>
            <li> <a href="/admin_products">Produits</a></li>
            <li> <a href="/admin_orders">Commandes</a></li>
            <li> <a href="/admin_users">Utilisateurs</a></li>
            <li> <a href="/admin_contacts">Messages</a></li>
         </ul>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars" ></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <img src="./ressources/pictures_users/<?= $_SESSION['user_image']; ?>" alt="">
         <p><?= $_SESSION['user_name']; ?></p>
         <a href="/" class="btn">Accueil</a>
         <a href="/admin_update_profile" class="btn">Mise À Jours/Profile</a>
         <a href="/logout" class="delete-btn option-btn">Se déconnecter</a>
         
         <!-- <div class="flex-btn">
            <a href="login.php" class="option-btn">Se connecter</a>
            <a href="register.php" class="option-btn">S'inscrire</a>
         </div> -->
      </div>

   </div>

</header>