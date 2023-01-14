<?php
use App\Controllers\OrdersController;

?>

<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Commandes</title>

  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./ressources/css/style.css">
   <link rel="stylesheet" href="./ressources/css/footer.css">


</head>
<body>
   
<?php include 'header.php'; ?>

<section class="placed-orders">

   <h1 class="title">Commandes passées</h1>

   <div class="box-container">

   <?php
   $fetch_orders = OrdersController::getOrders();
      
   if (isset($fetch_orders) && count($fetch_orders) > 0) {
   foreach ($fetch_orders as $key => $value)  {   
   ?>
   <div class="box">
      <p> Effectuée le : <span><?= $value['placed_on']; ?></span> </p>
      <p> Nom : <span><?= $value['name']; ?></span> </p>
      <p> Numero : <span><?= $value['number']; ?></span> </p>
      <p> Email : <span><?= $value['email']; ?></span> </p>
      <p> Adresse : <span><?= $value['address']; ?></span> </p>
      <p> Mode de paiement : <span><?= $value['method']; ?></span> </p>
      <p> Vos commandes : <span><?= $value['total_products']; ?></span> </p>
      <p> Prix total : <span><?= $value['total_price']; ?>€</span> </p>
      <p> Statut de paiement : <span style="color:<?php if($value['payment_status'] == 'En attente'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $value['payment_status']; ?></span> </p>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">Aucune commandes passées!</p>';
   }
   ?>

   </div>

</section>










<script src="./ressources/js/script.js"></script>
<script src="https://kit.fontawesome.com/c4a535f47e.js"></script>

<?php include 'footer.php'; ?>

</body>
</html>