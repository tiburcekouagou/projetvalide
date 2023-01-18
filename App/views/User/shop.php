<?php
use App\Controllers\CardController;
use App\Controllers\ProductController;
// session_start();

$add = ProductController::add();


?>

<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Boutique</title>

  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./ressources/css/style.css">
   <link rel="stylesheet" href="./ressources/css/footer.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="p-category">

   <a href="/category?category=hamburges">Hamburgés</a>
   <a href="/category?category=a-cote">A côtés</a>
   <a href="/category?category=desserts">Désserts</a>
   <a href="/category?category=boissons">Boissons</a>

</section>

<section class="products">

   <h1 class="title">Nouveaux produits</h1>

   <div class="box-container">

   <?php
   $select_products = ProductController::getAllProduct();
      
      if(count($select_products) > 0){
         foreach ($select_products as $key => $value) {
            # code...
         
   ?>
   <form action="product/add" class="box" method="POST">
      <div class="price"><span><?= $value['price']; ?></span>€</div>
      <a href="/views?pid=<?= $value['id']; ?>" class="fas fa-eye"></a>
      <img src="./ressources/products_images/<?= $value['image']; ?>" alt="">
      <div class="name"><?= $value['name']; ?></div>
      <input type="hidden" name="pid" value="<?= $value['id']; ?>">
      <input type="hidden" name="p_name" value="<?= $value['name']; ?>">
      <input type="hidden" name="p_price" value="<?= $value['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $value['image']; ?>">
      <input type="hidden" type="number" min="1" value="1" name="p_qty" class="qty">
      <input type="submit" value="Ajouter à la liste d'envie" class="option-btn" name="add_to_wishlist">
      <input type="submit" value="Ajouter au panier" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">Aucun produit existant!</p>';
   }
   ?>

   </div>

</section>









<script src="./ressources/js/script.js"></script>
<script src="https://kit.fontawesome.com/c4a535f47e.js"></script>

<?php include 'footer.php'; ?>

</body>
</html>