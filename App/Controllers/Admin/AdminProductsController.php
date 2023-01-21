<?php
namespace App\Controllers;

use App\Models\OrdersModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use App\Models\ContactModel;

class AdminProductsController {

    public $user;


    public $name;
    public $category;
    public $price;
    public $details;
    
    public $image_name ;
    public $image_tmpname ;
    public $image_size ;
    public $image_error ;

    public $extensions ;

    public $tableau_extensions ;
    public $size ;

    public $selectProducts;

    
    
    
    public function insertProducts(){
        session_start();
        
        
        if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_product'])) {
        
    
            $this->name = $_POST["name"];
            $this->category = $_POST["category"];
            $this->price = $_POST["price"];
            $this->details = $_POST["details"];

            $this->image_name = $_FILES["image"]["name"];
            $this->image_tmpname = $_FILES["image"]["tmp_name"];
            $this->image_size = $_FILES["image"]["size"];
            $this->image_error = $_FILES["image"]["error"];

            $this->extensions = explode(".", $this->image_name);
            $this->extensions = strtolower(end($this->extensions));

            $this->tableau_extensions = ['jpg', 'png', 'jpeg'];
            $this->size = 5000000;

            $this->selectProducts = ProductModel::selectProducts($this->name);

            if ($this->selectProducts > 0) {
                echo "  <script>
                            alert(Un produits existe déja avec ce nom)
                        </script>
                    ";
                    header('Location:/admin_products');
                exit();
            }else {
                
                $this->picturesImages();
            }


        }
          
    }

    

    public function picturesImages() {
        if(in_array($this->extensions, $this->tableau_extensions)) {

            if($this->image_size <= $this->size) {

                if($this->image_error == 0) {

                    $generate_name = uniqid("img-user-", true);
                    // pour générer img-user-63c6cc4e6e1d91.28889735

                    $generate_result = $generate_name . "." . $this->extensions;
                    // pour générer img-user-63c6cc4e6e1d91.28889735.extension de l'image

                    $parent = "../Public/ressources/products_images/$generate_result";
                    move_uploaded_file($this->image_tmpname, $parent);

                    ProductModel::insertProducts($this->name, $this->category, $this->details, $this->price, $generate_result);
                   
                    header("Location:/admin_products");
                    exit();
                } else {
                    header("Location:/admin_products");
                    echo "<script> alert('Image non pris en charge') </script>";
                    exit();
                }
            } else {
                header("Location:/admin_product");
                echo "<script> alert('La aille de l\'image est trop grande') </script>";
                exit();
            }
        } else {
            header("Location:/admin_products");
            echo "Insérer une image ou modifier le format de l\'image";
            exit();
        }
    }

    public static function deleteProduct(){
        

        if(isset($_GET['delete'])){

            $delete_id = $_GET['delete'];

            $fetch_delete_image = ProductModel::selectImage($delete_id);

            unlink('./ressources/products_images/'.$fetch_delete_image['image']);
            
            ProductModel::deleteAll($delete_id);

            header('location:/admin_products');


        }
    }
    
}
       