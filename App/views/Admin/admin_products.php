<?php
use App\Controllers\ProductController;
use App\Controllers\AdminProductsController;
session_start();

if ($_SESSION['role'] !== 'admin' ) {
   header('Location:/');
}
AdminProductsController::deleteProduct();


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./ressources/css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="add-products">

   <h1 class="title"> Ajouter un nouveau produit</h1>

   <form action="AdminProducts/insertProducts" method="POST" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
         <input type="text" name="name" class="box" required placeholder="Entrez le nom du produit">
         <select name="category" class="box" required>
            <option value="" selected disabled>Choisir une catégorie</option>
               <option value="hamburges">Hamburges</option>
               <option value="a-cote">A côté</option>
               <option value="desserts">Désserts</option>
               <option value="boissons">Boissons</option>
         </select>
         </div>
         <div class="inputBox">
         <input type="number" min="0" name="price" class="box" required placeholder="Entrez le prix du produit">
         <input type="file" name="image"  class="box" accept="image/jpg, image/jpeg, image/png">
         </div>
      </div>
      <textarea name="details" class="box" required placeholder="Entrer les détails du produit" cols="30" rows="10"></textarea>
      <input type="submit" class="btn" value="Ajouter un produit" name="add_product">
   </form>

</section>

<section class="show-products">

   <h1 class="title">Produits ajoutés</h1>

   <div class="box-container">

   <?php
      $select_products = ProductController::getAllProduct();


      if(count($select_products) > 0){
         foreach ($select_products as $key => $value) {
         
   ?>
   <div class="box">
      <div class="price"><?= $value['price']; ?>€</div>
      <img src="./ressources/products_images/<?= $value['image']; ?>" alt="">
      <div class="name"><?= $value['name']; ?></div>
      <div class="cat"><?= $value['category']; ?></div>
      <div class="details"><?= $value['details']; ?></div>
      <div class="flex-btn">
         <a href="/update_product?update=<?= $value['id']; ?>" class="option-btn">Mettre à jour</a>
         <a href="/admin_products?delete=<?= $value['id']; ?>" name="delete" class="delete-btn" onclick="return confirm('Voulez-vous vraiment supprimer ce produit?');">Supprimer</a>
      </div>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">Aucun produits existant. Veuillez ajouter un nouveau produit !</p>';
   }
   ?>

   </div>

</section>

<!-- C'est un fruit très riches que tu peux prendre après avoir déguster un bon hamburger! -->











<script src="./ressources/js/script.js"></script>

<script src="https://kit.fontawesome.com/c4a535f47e.js"></script>

</body>
</html>