<?php

@include 'config.php';

session_start();

if ($_SESSION['role'] !== 'admin' ) {
   header('Location:/');
}





?>

<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Messages</title>

  
   <!-- custom css file link  -->
   <link rel="stylesheet" href="./ressources/css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="messages">

   <h1 class="title">Messages</h1>

   <div class="box-container">

   <?php
if (isset($fetch_message) && count($fetch_message) > 0) {
 foreach ($fetch_message as $key => $value) {
   ?>
   <div class="box">
      <p> Nom : <span><?= $value['name']; ?></span> </p>
      <p> Numero : <span><?= $value['number']; ?></span> </p>
      <p> Email : <span><?= $value['email']; ?></span> </p>
      <p> Message : <span><?= $value['message']; ?></span> </p>
      <a href="/admin_contacts?delete=<?= $value['id']; ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce message?');" class="delete-btn">Supprimer</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">Vous n\'avez pas de messages!</p>';
      }
   ?>

   </div>

</section>













<script src="./ressources/js/script.js"></script>
<script src="https://kit.fontawesome.com/c4a535f47e.js"></script>

</body>
</html>