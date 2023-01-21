<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Utilisateurs</title>

  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./ressources/css/admin_style.css">
   <link rel="stylesheet" href="./ressources/css/footer.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="user-accounts">

   <h1 class="title">Comptes utilisateur</h1>

   <div class="box-container">

      <?php

        foreach ($fetch_users as $key => $value) {
      ?>
      <div class="box">
         <img src="./ressources/uploaded_img/<?= $value['image']; ?>" alt="">
         <p> Id utilisateur : <span><?= $value['id']; ?></span></p>
         <p> Nom d'utilisateur : <span><?= $value['name']; ?></span></p>
         <p> Email : <span><?= $value['email']; ?></span></p>
         <p> Rôle : <span style=" color:<?php if($value['user_type'] == 'admin'){ echo 'orange'; }; ?>"><?= $value['user_type']; ?></span></p>
         <a href="/admin_users?delete=<?= $value['id']; ?>" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur?');" class="delete-btn">Supprimer</a>
      </div>
      <?php
      }
      ?>
   </div>
   <?php
   // A mettre en attribut dans une balise style .
   // if($value['user_type'] == $_SESSION['role']){ echo 'display:none'; }; 
   ?>

</section>













<script src="./ressources/js/script.js"></script>
<script src="https://kit.fontawesome.com/c4a535f47e.js"></script>

</body>
</html>