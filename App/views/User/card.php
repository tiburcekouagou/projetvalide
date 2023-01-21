<?php
use   App\Controllers\CardController;

$cardAction = CardController::cardAction();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Panier</title>

  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./ressources/css/style.css">
   <link rel="stylesheet" href="./ressources/css/footer.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="shopping-cart">

   <h1 class="title">Produits ajoutés</h1>

   <div class="box-container">

   <?php
      $grand_total = 0;
      $select_cart = CardController::select_cart();

      if(isset($select_cart) && count($select_cart) > 0){
         foreach ($select_cart as $key => $value) {
            # code...
         
   ?>
   <form action="" method="POST" class="box">
      <a href="/card?delete=<?= $value['id']; ?>" 
         onclick="return confirm('Supprimer ceci du panier ?');">
      
         <i class="fas fa-times" ></i>

   </a>
      <a href="/views?pid=<?= $value['pid']; ?>" >
      <i class="fas fa-eye" ></i>

      </a>
      <img src="./ressources/products_images/<?= $value['image']; ?>" alt="">
      <div class="name"><?= $value['name']; ?></div>
      <div class="price"><?= $value['price']; ?>€</div>
      <input type="hidden" name="cart_id" value="<?= $value['id']; ?>">
      <div class="flex-btn">
         <input type="number" min="1" value="<?= $value['quantity']; ?>" class="qty" name="p_qty">
         <input type="submit" value="Mettre à jour" name="update_qty" class="option-btn">
      </div>
      <div class="sub-total"> Sous-total : <span><?= $sub_total = ($value['price'] * $value['quantity']); ?>€</span> </div>
   </form>
   <?php
      $grand_total += $sub_total;
      }
   }else{
      echo '<p class="empty">Votre panier est vide</p>';
   }
   ?>
   </div>

   <div class="cart-total">
      <p>Grand total : <span><?= $grand_total; ?>€</span></p>
      <a href="/shop" class="option-btn">Continuer vos achats</a>
      <a href="/card?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>">Supprimer tout</a>
      <a href="/checkout" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">Passer à la caisse</a>
   </div>

</section>









<script src="./ressources/js/script.js"></script>
<script src="https://kit.fontawesome.com/c4a535f47e.js"></script>

<?php include 'footer.php'; ?>

</body>
</html>