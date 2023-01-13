<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = htmlspecialchars($email);
   $pass = md5($_POST['pass']);
   $pass = htmlspecialchars($pass);

   $sql = "SELECT * FROM `users` WHERE email = ? AND password = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$email, $pass]);
   $rowCount = $stmt->rowCount();  

   $row = $stmt->fetch(PDO::FETCH_ASSOC);

   if($rowCount > 0){

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_id'] = $row['id'];
         header('location:/admin');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_id'] = $row['id'];
         header('location:/');

      }else{
         $message[] = 'Aucun utilisateur trouvé !';
      }

   }else{
      $message[] = 'Email ou mot de passe incorrect!';
   }

}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Connexion</title>

  

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

   <form action="/login/macth" method="POST">
      <h3>Se connecter maintenant</h3>
      <p>pour avoir une meilleur expérience! 😋</p>
      <input type="email" name="email" class="box" placeholder="Entrer votre email" required>
      <input type="password" name="pass" class="box" placeholder="Entrer votre mot de passe" required>
      <input type="submit" value="Se connecter" class="btn" name="submit">
      <p>Vous n'avez pas de compte ? <a href="/register">S'inscrire maintenant</a></p>
   </form>

</section>


</body>
</html>