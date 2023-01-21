<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Commandes</title>

  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./ressources/css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="placed-orders">

   <h1 class="title">Commandes passées</h1>

   <div class="box-container">

      <?php
         if (isset($fetch_orders) && count($fetch_orders) > 0) {
               foreach ($fetch_orders as $key => $value) {
           
      ?>
      <div class="box">
         <p> Id utilisateur : <span><?= $value['user_id']; ?></span> </p>
         <p> Effectuer le : <span><?= $value['placed_on']; ?></span> </p>
         <p> Nom  : <span><?= $value['name']; ?></span> </p>
         <p> Email : <span><?= $value['email']; ?></span> </p>
         <p> Téléphone : <span><?= $value['number']; ?></span> </p>
         <p> Adresse : <span><?= $value['address']; ?></span> </p>
         <p> Produits totaux : <span><?= $value['total_products']; ?></span> </p>
         <p> Prix total : <span><?= $value['total_price']; ?>€</span> </p>
         <p> Mode de paiement : <span><?= $value['method']; ?></span> </p>
         <form action="" method="POST">
            <input type="hidden" name="order_id" value="<?= $value['id']; ?>">
            <select name="update_payment" class="drop-down">
               <!-- <option value="" selected disabled><?= $value['payment_status']; ?></option> -->
               <option value="En attente" selected>En attente</option>
               <option value="Completé">Complété</option>
            </select>
            <div class="flex-btn">
               <input type="submit" name="update_order" class="option-btn" value="Metre à jour">
               <a href="/admin_orders?delete=<?= $value['id']; ?>" class="delete-btn" onclick="return confirm('Voulez -vous supprimer cette commande ?');">Supprimer</a>
            </div>
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">Aucune commandes passées !</p>';
      }
      ?>

   </div>

</section>












<script src="./ressources/js/script.js"></script>
<script src="https://kit.fontawesome.com/c4a535f47e.js"></script>

</body>
</html>