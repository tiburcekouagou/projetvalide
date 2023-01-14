<?php
use App\Controllers\ContactController;

// $sendAction = ContactController::sendMessage();


?>

<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./ressources/css/style.css">
   <link rel="stylesheet" href="./ressources/css/footer.css">


</head>
<body>
   
<?php include 'header.php'; ?>

<section class="contact">

   <h1 class="title">Entrer en contact avec nous</h1>

   <form action="contact/sendMessage" method="POST">
      <input type="text" name="name" class="box" required placeholder="Nom complet">
      <input type="email" name="email" class="box" required placeholder="Email">
      <input type="number" name="number" min="0" class="box" required placeholder="Numero de téléphone">
      <textarea name="msg" class="box" required placeholder="Entrer votre message" cols="30" rows="10"></textarea>
      <input type="submit" value="Envoyer message" class="btn" name="send">
   </form>

</section>









<script src="./ressources/js/script.js"></script>
<script src="https://kit.fontawesome.com/c4a535f47e.js"></script>

<?php include 'footer.php'; ?>

</body>
</html>