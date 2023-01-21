<?php
session_start();

if ($_SESSION['role'] !== 'admin' ) {
   header('Location:/');
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Mettre à jour les produits</title>

  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./ressources/css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="update-product">

   <h1 class="title"> Mettre à jour le produit</h1>  
   
   

   <form action=" AdminUpdateProduct/updateProducts" method="post" enctype="multipart/form-data">
      <input type="hidden" name="old_image" value="<?= $fetch_product['image']; ?>">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <img src="./ressources/products_images/<?= $fetch_product['image']; ?>" alt="">
      <input type="text" name="name" placeholder="Entrez le nom du produit" required class="box" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="old_name" class="box" value="<?= $fetch_product['name']; ?>">
      <input type="number" name="price" min="0" placeholder="Entrez le prix du produit" required class="box" value="<?= $fetch_product['price']; ?>">
      <select name="category" class="box" required>
         <option selected><?= $fetch_product['category']; ?></option>
         <option value="hamburges">Hamburgés</option>
         <option value="a-cote">A côté</option>
         <option value="desserts">Désserts</option>
         <option value="boissons">Boissons</option>
      </select>
      <textarea name="details" required placeholder="Entrer le détail du produit" class="box" cols="30" rows="10"><?= $fetch_product['details']; ?></textarea>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png" required>
      <div class="flex-btn">
         <input type="submit" class="btn" value="Mettre à jour le produit" name="update_product">
         <a href="/admin_products" class="option-btn">Retourner</a>
      </div>
   </form>

</section>













<script src="./ressources/js/script.js"></script>
<script src="https://kit.fontawesome.com/c4a535f47e.js"></script>

</body>
</html>