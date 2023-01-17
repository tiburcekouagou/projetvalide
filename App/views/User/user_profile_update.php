<?php

use App\Controllers\UpdateController;
// $updateProfile = UpdateController::updateProfile();




?>


<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Mettre à jour le profile</title>

  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./ressources/css/components.css">
   <link rel="stylesheet" href="./ressources/css/footer.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="update-profile">

   <h1 class="title">Mettre à jour du profile</h1>

   <form action="/Update/updateProfile" method="POST" enctype="multipart/form-data">
      <img src="./ressources/pictures_users/<?= $_SESSION['user_image']; ?>" alt="">
      <div class="flex">
         <div class="inputBox">
            <span>Nom d'utilisateur :</span>
            <input type="hidden" name="id" value="<?=$_SESSION['user_id']; ?>">
            <input type="text" name="name" value="<?=$_SESSION['user_name']; ?>" placeholder="Mettre à jour le nom" required class="box">
            <span>Email :</span>
            <input type="email" name="email" value="<?= $_SESSION ['user_email']; ?>" placeholder="Mettre à jour l'email" required class="box">
            <span>Mettre à jour la photo :</span>
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box">
            <input type="hidden" name="old_image" value="<?= $_SESSION['user_image']; ?>">
         </div>
         <div class="inputBox">
            <span>Ancien mot de passe :</span>
            <input type="password" name="update_pass" placeholder="Entre le mot de passe précedent" class="box">
            <span>Nouveau mot de passe :</span>
            <input type="password" name="new_pass" placeholder="Entrer le nouveau mot de passe" class="box">
            <span>Confirmer le mot de passe :</span>
            <input type="password" name="confirm_pass" placeholder="Confirmer le nouveau mot de passe" class="box">
         </div>
      </div>
      <div class="flex-btn">
         <input type="submit" class="btn" value="Mise à jour / profile" name="update_profile">
         <a href="/" class="option-btn">Retour</a>
      </div>
   </form>

</section>












<script src="./ressources/js/script.js"></script>
<script src="https://kit.fontawesome.com/c4a535f47e.js"></script>

<?php include 'footer.php'; ?>

</body>
</html>