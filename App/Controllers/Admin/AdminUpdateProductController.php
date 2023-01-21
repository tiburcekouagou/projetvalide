<?php
namespace App\Controllers;

use App\Models\OrdersModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use App\Models\ContactModel;
use \Core\View;

class AdminUpdateProductController {

    public $id;


    public $name;
    public $old_name;
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

    
    
    public function updateProducts(){
        session_start();
        
        
        if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_product'])) {
        
            $this->id = $_POST['pid'];
            $this->name = $_POST["name"];
            $this->old_name = $_POST["old_name"];
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
            // print_r($this->selectProducts);
            // print_r($this->name);
            // print_r($this->old_name);
            // exit();

            if ($this->selectProducts > 0) {
                if ($this->name = $this->old_name ) {
                    $this->picturesImages();
                }
                else {
                    echo "  <script>
                                alert(Un produits existe déja avec ce nom)
                            </script>
                        ";
                        header('Location:/update_products?update=$this->id&Nomexistedeja');
                    exit();
                }
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


                  

                    ProductModel::updateProduct($this->name, $this->category, $this->details, $this->price, $generate_result, $this->id);
                    
                 
                   
                    header("Location:/update_product?update=$this->id&Fais");
                    exit();
                } else {
                    header("Location:/update_productupdate =$this->id&Nonprisencharge");
                    echo "<script> alert('Image non pris en charge') </script>";
                    exit();
                }
            } else {
                header("Location:/update_productupdate =$this->id&latailledelimageestgrande");
                echo "<script> alert('La aille de l\'image est trop grande') </script>";
                exit();
            }
        } else {
            header("Location:/update_productupdate =$this->id&Modifier");
            echo "Insérer une image ou modifier le format de l\'image";
            exit();
        }
    }

    public static function getOneProduct(){

        $update_id = $_GET['update'];

       $fetch_product = ProductModel::getOneProduct($update_id);
       return $fetch_product;

    }
    
}
       