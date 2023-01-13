<?php

@include 'config.php';

use App\Controllers\Connexion;

$connexion = new Connexion ;
$conn = $connexion->connect();



if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};


if(isset($_POST['update_profile'])){
   
   $user_id = $_SESSION['user_id'];
   
   if(!isset($user_id)){
      header('location:/login');
   };

   $name = $_POST['name'];
   $name = htmlspecialchars($name);
   $email = $_POST['email'];
   $email = htmlspecialchars($email);

   $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
   $update_profile->execute([$name, $email, $user_id]);

   $image = $_FILES['image']['name'];
   $image = htmlspecialchars($image);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = './ressources/uploaded_img/'.$image;
   $old_image = $_POST['old_image'];

   if(!empty($image)){
      if($image_size > 5000000){
         $message[] = 'La taille de l\'image est trop grande!';
      }else{
         $update_image = $conn->prepare("UPDATE `users` SET image = ? WHERE id = ?");
         $update_image->execute([$image, $user_id]);
         if($update_image){
            move_uploaded_file($image_tmp_name, $image_folder);
            unlink('./ressources/uploaded_img/'.$old_image);
            $message[] = 'Image mise à jour avec succès';
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
         $message[] = 'Ancien mot de passe incorrect';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'Mot de passe de confirmation incorrect';
      }else{
         $update_pass_query = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
         $update_pass_query->execute([$confirm_pass, $user_id]);
         $message[] = 'Mot de passe mise à jour avec succès!';
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
   <title>Mettre à jour le profile</title>

  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./ressources/css/components.css">
   <link rel="stylesheet" href="./ressources/css/footer.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="update-profile">

   <h1 class="title">Mettre à jour du profile</h1>

   <form action="" method="POST" enctype="multipart/form-data">
      <img src="./ressources/uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
      <div class="flex">
         <div class="inputBox">
            <span>Nom d'utilisateur :</span>
            <input type="text" name="name" value="<?= $fetch_profile['name']; ?>" placeholder="update username" required class="box">
            <span>Email :</span>
            <input type="email" name="email" value="<?= $fetch_profile['email']; ?>" placeholder="update email" required class="box">
            <span>Mettre à jour la photo :</span>
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box">
            <input type="hidden" name="old_image" value="<?= $fetch_profile['image']; ?>">
         </div>
         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?= $fetch_profile['password']; ?>">
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