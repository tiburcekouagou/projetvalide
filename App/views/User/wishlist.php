<?php

use App\Controllers\WishlistController;

$wishAction = WishlistController::wishAction();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Liste des envies</title>

  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./ressources/css/style.css">
   <link rel="stylesheet" href="./ressources/css/footer.css">
   


</head>
<body>
   
<?php include 'header.php'; ?>

<section class="wishlist">

   <h1 class="title">Produits ajoutés</h1>

   <div class="box-container">

   <?php

      $grand_total = 0;
      $showWishlist = WishlistController::returnWishlist();

      // echo "<pre>";
      // print_r($showWishlist);
      // echo "<pre>";
      // exit();
   
      if(isset($showWishlist)  && count($showWishlist) > 0){
        foreach ($showWishlist as $key => $value) {
         
   ?>
   <form action="" method="POST" class="box">
      <a href="/wishlist?delete=<?= $value['id']; ?>" onclick="return confirm('Supprimer ceci de la liste d\'envie ?');">
      <i class="fas fa-times" ></i>

      </a>
      <a href="/views?pid=<?= $value['pid']; ?>">
      <i class="fas fa-eye" ></i>

      </a>
      <img src="./ressources/products_images/<?= $value['image']; ?>" alt="">
      <div class="name"><?= $value['name']; ?></div>
      <div class="price"><?= $value['price']; ?>€</div>
      <input type="number" min="1" value="1" class="qty" name="p_qty">
      <input type="hidden" name="pid" value="<?= $value['pid']; ?>">
      <input type="hidden" name="p_name" value="<?= $value['name']; ?>">
      <input type="hidden" name="p_price" value="<?= $value['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $value['image']; ?>">
      <input type="submit" value="Ajouter au panier" name="add_to_cart" class="btn">
   </form>
   <?php
      $grand_total += $value['price'];
      }
   }else{
      echo '<p class="empty">Votre liste d\'envie est vide</p>';
   }
   ?>
   </div>

   <div class="wishlist-total">
      <p>Grand total : <span><?= $grand_total; ?>€</span></p>
      <a href="/shop" class="option-btn">Continuer vos achats</a>
      <a href="/wishlist?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>">Tout supprimer</a>
   </div>

</section>









<script src="./ressources/js/script.js"></script>
<script src="https://kit.fontawesome.com/c4a535f47e.js"></script>

<?php include 'footer.php'; ?>

</body>
</html>