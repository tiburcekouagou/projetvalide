<?php

@include 'config.php';

session_start();

if ($_SESSION['role'] !== 'admin' ) {
   header('Location:/');
}



if(isset($_POST['update_profile'])){

   $name = $_POST['name'];
   $name = htmlspecialchars($name);
   $email = $_POST['email'];
   $email = htmlspecialchars($email);

   $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
   $update_profile->execute([$name, $email, $admin_id]);

   $image = $_FILES['image']['name'];
   $image = htmlspecialchars($image);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = './ressources/uploaded_img/'.$image;
   $old_image = $_POST['old_image'];

   if(!empty($image)){
      if($image_size > 5000000){
         $message[] = 'La taille de l\'image est trop grande !';
      }else{
         $update_image = $conn->prepare("UPDATE `users` SET image = ? WHERE id = ?");
         $update_image->execute([$image, $admin_id]);
         if($update_image){
            move_uploaded_file($image_tmp_name, $image_folder);
            unlink('./ressources/uploaded_img/'.$old_image);
            $message[] = 'Image mise à jour avec succès !';
         };
      };
   };

   $old_pass = $_POST['old_pass'];
   $update_pass = md5($_POST['update_pass']);
   $update_pass = htmlspecialchars($update_pass);
   $new_pass = md5($_POST['new_pass']);
   $new_pass = htmlspecialchars($new_pass);
   $confirm_pass = md5($_POST['confirm_pass']);
   $confirm_pass = htmlspecialchars($confirm_pass);

   if(!empty($update_pass) AND !empty($new_pass) AND !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'L\'ancien mot de passe ne correspond pas !';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'Le mot de passe ne correspond pas !';
      }else{
         $update_pass_query = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
         $update_pass_query->execute([$confirm_pass, $admin_id]);
         $message[] = 'Mot de passe mis à jour avec succès!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Mettre à jour le profil administrateur</title>

  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./ressources/css/components.css">
   <link rel="stylesheet" href="./ressources/css/footer.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="update-profile">

   <h1 class="title">Mettre à jour le profil</h1>

   <form action="/AdminUpdateProfile/updateProfile" method="POST" enctype="multipart/form-data">
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
         <input type="submit" class="btn" value="Mettre à jour le profil" name="update_profile">
         <a href="/admin" class="option-btn">Retour</a>
      </div>
   </form>

</section>













<script src="./ressources/js/script.js"></script>
<script src="https://kit.fontawesome.com/c4a535f47e.js"></script>

</body>
</html>