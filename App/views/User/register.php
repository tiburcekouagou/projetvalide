

<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Inscription</title>

  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./ressources/css/components.css">
   <link rel="stylesheet" href="./ressources/css/footer.css">

</head>
<body>

<?php

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
   
<section class="form-container">

   <form action="/register/getting" enctype="multipart/form-data" method="POST">
      <h3>S'inscrire maintenant</h3>
      <p>pour avoir une meilleur expérience! 😋</p>
      <input type="text" name="name" class="box" placeholder="Entre votre nom complet" required>
      <input type="email" name="email" class="box" placeholder="Entrer votre email" required>
      <input type="password" name="pass" class="box" placeholder="Entrer votre mot de passe" required>
      <input type="password" name="cpass" class="box" placeholder="Confirmer votre mot de passe" required>
      <!-- <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png"> -->
      <input type="submit" value="S'inscrire" class="btn" name="submit">
      <p>Vous avez déjà un compte? <a href="/login">Se connecter</a></p>
   </form>

</section>


</body>
</html>