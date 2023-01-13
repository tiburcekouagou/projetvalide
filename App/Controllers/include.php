<?php
require "ShopRayController.php";
require "../../models/ProductModel.php";
 $shopraycon = new ShopRayController();
 $array0 = $shopraycon->returnAll();
 $array_distinct = $shopraycon->returnDistinct();
 $ProductModel = new ProductModel();
 $array = $ProductModel->SelectAllProducts($url);
 $count = count($array);

 ?>