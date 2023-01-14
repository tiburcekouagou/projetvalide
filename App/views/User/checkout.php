<?php
use App\Controllers\CheckoutController;
use App\Controllers\CardController;

$checkoutAction = CheckoutController::checkoutAction();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./ressources/css/style.css">
   <link rel="stylesheet" href="./ressources/css/footer.css">

   
</head>
<body>
   
<?php include 'header.php'; ?>

<section class="display-orders">

   <?php
      $cart_grand_total = 0;
      $select_cart_items = CardController::select_cart();
      if (isset($select_cart_items) && count($select_cart_items)) {
         
            foreach ($select_cart_items as $key => $value) {
               
                  $cart_total_price = ($value['price'] * $value['quantity']);
                  $cart_grand_total += $cart_total_price;
   ?>
   <p> <?= $value['name']; ?> <span>(<?=$value['price'].'€ x '. $value['quantity']; ?>)</span> </p>
   <?php
    }
   }else{
      echo '<p class="empty">Votre panier est vide!</p>';
   }
   ?>
   <div class="grand-total">Grand total : <span><?= $cart_grand_total; ?>€</span></div>
</section>

<section class="checkout-orders">

   <form action="" method="POST">

      <h3>Passer votre commande</h3>

      <div class="flex">
         <div class="inputBox">
            <span>Votre nom complet :</span>
            <input type="text" name="name" placeholder="Entrer votre nom complet" class="box" required>
         </div>
         <div class="inputBox">
            <span>Votre numero :</span>
            <input type="number" name="number" placeholder="Entrer votre numero de téléphone" class="box" required>
         </div>
         <div class="inputBox">
            <span>Votre email :</span>
            <input type="email" name="email" placeholder="Entrer votre email" class="box" required>
         </div>
         <div class="inputBox">
            <span>Mode de paiment :</span>
            <select name="method" class="box" required>
               <option value="Paiement à la livraison">Paiement à la livraison</option>
               <option value="MTN Mobile Money">MTN Mobile Money </option>
               <option value="Moov flooz">Moov flooz</option>
               <option value="Cart de crédit">Cart de crédit</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Maison:</span>
            <input type="text" name="flat" placeholder="ex: Maison Boni" class="box" required>
         </div>
         <div class="inputBox">
            <span>Quartier :</span>
            <input type="text" name="street" placeholder="ex: Cadjehoun" class="box" required>
         </div>
         <div class="inputBox">
            <span>Ville :</span>
            <input type="text" name="city" placeholder="ex: Cotonou" class="box" required>
         </div>
         <div class="inputBox">
            <span>Département :</span>
            <input type="text" name="state" placeholder="ex: Littoral" class="box" required>
         </div>
         <div class="inputBox">
            <span>Pays :</span>
            <input type="text" name="country" placeholder="ex: Benin" class="box" required>
         </div>
         <div class="inputBox">
            <span>Code pin :</span>
            <input type="number" min="0" name="pin_code" placeholder="ex: 123456" class="box" required>
         </div>
      </div>

      <input type="submit" name="order" class="btn <?= ($cart_grand_total > 1)?'':'disabled'; ?>" value="Passer la commande">

   </form>

</section>









<script src="./ressources/js/script.js"></script>
<script src="https://kit.fontawesome.com/c4a535f47e.js"></script>

<?php include 'footer.php'; ?>

</body>
</html>