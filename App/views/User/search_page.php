<?php
use App\Controllers\ProductController;

$addAction = ProductController::add();


?>


<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Page de recherche</title>

  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./ressources/css/style.css">
   <link rel="stylesheet" href="./ressources/css/footer.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="search-form">

   <form action="" method="POST">
      <input type="text" class="box" name="search_box" placeholder="Recherche de produits...">
      <input type="submit" name="search_btn" value="Rechercher" class="btn">
   </form>

</section>

<?php



?>

<section class="products" style="padding-top: 0; min-height:100vh;">

   <div class="box-container">

   <?php
     $fetch_products = ProductController::searchProduct();

     if (isset($fetch_products) && count($fetch_products) > 0) {
  
         foreach ($fetch_products as $key => $value) {  
      ?>
   <form action="" class="box" method="POST">
      <div class="price"><span><?= $value['price']; ?></span>€</div>
      <a href="/views?pid=<?= $value['id']; ?>" class="fas fa-eye"></a>
      <img src="./ressources/products_images/<?= $value['image']; ?>" alt="">
      <div class="name"><?= $value['name']; ?></div>
      <input type="hidden" name="pid" value="<?= $value['id']; ?>">
      <input type="hidden" name="p_name" value="<?= $value['name']; ?>">
      <input type="hidden" name="p_price" value="<?= $value['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $value['image']; ?>">
      <input type="number" min="1" value="1" name="p_qty" class="qty">
      <input type="submit" value="Ajouter à la liste d'envie" class="option-btn" name="add_to_wishlist">
      <input type="submit" value="Ajouter au panier" class="btn" name="add_to_cart">
   </form>
   <?php
    
         }
      }else{
         echo '<p class="empty">Aucun résultat</p>';
      }
      
   // };
   ?>

   </div>

</section>







<script src="./ressources/js/script.js"></script>
<script src="https://kit.fontawesome.com/c4a535f47e.js"></script>

<?php include 'footer.php'; ?>

</body>
</html>