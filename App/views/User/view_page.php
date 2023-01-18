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
   <title>Vue rapide</title>

  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./ressources/css/style.css">
   <link rel="stylesheet" href="./ressources/css/footer.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="quick-view">

   <h1 class="title">Vue rapide</h1>
  

   <?php
      $pid = $_GET['pid'];
      $select_products = ProductController::getOneProduct($pid);
   ?>
   <form action="" class="box" method="POST">
      <div class="price"><span><?= $select_products['price']; ?></span>€</div>
      <img src="./ressources/products_images/<?= $select_products['image']; ?>" alt="">
      <div class="name"><?= $select_products['name']; ?></div>
      <div class="details"><?= $select_products['details']; ?></div>
      <input type="hidden" name="pid" value="<?= $select_products['id']; ?>">
      <input type="hidden" name="p_name" value="<?= $select_products['name']; ?>">
      <input type="hidden" name="p_price" value="<?= $select_products['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $select_products['image']; ?>">
      <input type="hidden" type="number" min="1" value="1" name="p_qty" class="qty">
      <input type="submit" value="Ajouter à la liste d'envie" class="option-btn" name="add_to_wishlist">
      <input type="submit" value="Ajouter au panier" class="btn" name="add_to_cart">
   </form>

   <button class="option-btn" id="go-back">Retour!</button>

</section>



<script src="./ressources/js/script.js"></script>
<script src="https://kit.fontawesome.com/c4a535f47e.js"></script>
<script>
   document.getElementById('go-back').addEventListener('click', () => {
  history.back();
});
</script>

<?php include 'footer.php'; ?>

</body>
</html>