<?php
use App\Controllers\AdminHomeController;

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
   <title>Page admin</title>

  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./ressources/css/admin_style.css">
   <script src="https://kit.fontawesome.com/c4a535f47e.js"></script>

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="dashboard">

   <h1 class="title">Dashboard</h1>

   <div class="box-container">

      <div class="box">
      <?php
         $total_pendings = 0;
         $fetch_pendings = AdminHomeController::selectPendings();
         if (isset($fetch_pendings) && count($fetch_pendings) > 0) {
            foreach ($fetch_pendings as $key => $value) {
               $total_pendings += $value['total_price'];
            }
         }
        
      ?>
      <h3><?= $total_pendings; ?>€</h3>
      <p>Total des commandes en attentes</p>
      <a href="/admin_orders" class="btn">Voir commandes</a>
      </div>

      <div class="box">
      <?php
         $total_completed = 0;
         $fetch_completed = AdminHomeController::selectCompleted();
         
         if (isset($fetch_completed) && count($fetch_completed) > 0) {
            foreach ($fetch_completed as $key => $value) {
               $total_completed += $value['total_price'];
            }
         }
        
      ?>
      <h3><?= $total_completed; ?>€</h3>
      <p>Total des commandes terminées</p>
      <a href="/admin_orders" class="btn">Voir commandes</a>
      </div>

      <div class="box">
      <?php
        
         $number_of_orders = AdminHomeController::numberOfOrders();
      ?>
      <h3><?= $number_of_orders; ?></h3>
      <p>Nombres de commandes passées</p>
      <a href="/admin_orders" class="btn">Voir commandes</a>
      </div>

      <div class="box">
      <?php
         $number_of_products = AdminHomeController::numberOfProducts();
      ?>
      <h3><?= $number_of_products; ?></h3>
      <p>Nombre de produits ajoutés</p>
      <a href="/admin_products" class="btn">Voir produits</a>
      </div>

      <div class="box">
      <?php
         $number_of_users = AdminHomeController::numberOfUsers();
         ?>
      <h3><?= $number_of_users; ?></h3>
      <p>Nombre total d'utilisateurs</p>
      <a href="/admin_users" class="btn">Voir les comptes</a>
   </div>
   
   <div class="box">
      <?php
         $number_of_admins = AdminHomeController::numberOfAdmins();
         
         ?>
      <h3><?= $number_of_admins; ?></h3>
      <p>Nombre total d'administrateurs</p>
      <a href="/admin_users" class="btn">Voir comptes</a>
   </div>
   
   <div class="box">
      <?php
         $number_of_accounts = AdminHomeController::numberOfAccounts();
         
      ?>
      <h3><?= $number_of_accounts; ?></h3>
      <p>Nombre de comptes total</p>
      <a href="/admin_users" class="btn">Voir comptes</a>
      </div>

      <div class="box">
      <?php
         $number_of_messages = AdminHomeController::numberOfMessages();
         
      ?>
      <h3><?= $number_of_messages; ?></h3>
      <p>Nombre total de messages</p>
      <a href="/admin_contacts" class="btn">Voir messages</a>
      </div>

   </div>

</section>













<script src="./ressources/js/script.js"></script>
<script src="https://kit.fontawesome.com/c4a535f47e.js"></script>

</body>
</html>