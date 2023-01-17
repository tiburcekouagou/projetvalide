<?php
namespace App\Controllers;
use App\Models\UserModel;

class UpdateController {

    public $user;


    public $id;
    public $name;
    public $email;
    public $update_pass;
    public $new_pass;
    public $confirm_pass;
    public $image_name ;
    public $image_tmpname ;
    public $image_size ;
    public $image_error ;

    public $extensions ;

    public $tableau_extensions ;
    public $size ;
    public $old_image;
    
    
    
    public function updateProfile(){
        session_start();
        
        
        if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_profile'])) {
        
         $this->id = $_POST["id"];
         $this->name = $_POST["name"];
         $this->email = $_POST["email"];
         $this->old_image = $_POST["old_image"];



         $this->image_name = $_FILES["image"]["name"];
         $this->image_tmpname = $_FILES["image"]["tmp_name"];
         $this->image_size = $_FILES["image"]["size"];
         $this->image_error = $_FILES["image"]["error"];

         $this->extensions = explode(".", $this->image_name);
         $this->extension = strtolower(end($this->extensions));

         $this->tableau_extensions = ['jpg', 'png', 'jpeg'];
         $this->size = 5000000;

         $this->update_pass = $_POST["update_pass"];
         $this->new_pass = $_POST["new_pass"];
         $this->confirm_pass = $_POST["confirm_pass"];

         $this->controlPassword();

         $this->user = new UserModel();
         $array = $this->user->verifyId($this->id);
         $array1 = $this->user->verify($this->email);
         $count = count($array);
         $count1 = count($array1);

         if($count1>0) {
            if($array1[0]["email"] == $array[0]["email"]) {
                $password = password_verify($this->update_pass, $array1[0]["password"]);
                if($password) {
                    $this->picturesImages();
                    
                } else {
                    echo "<script>alert('Ancien Mot De Passe Non Conforme')</script>";
                    header("Location:/update");
                    exit();
                }
            } else {
                echo "<script>alert('Ce utilisateur existe déja')</script>";
                header("Location:/update");
                exit();
            }
         } else {
            if(password_verify($this->update_pass, $array[0]["password"])) {
                $this->picturesImages();
            } else {
                echo "<script>alert('Ce utilisateur existe déja')</script>";
                header("Location:/update");
                exit();
            }
         }


        }
    }

    public function controlPassword() {
        if($this->new_pass !== $this->confirm_pass) {
            echo "<script>alert('Mot de passe non conforme')</script>";
            header("Location:/update");
            exit();
        }
        return false;
    }

    public function picturesImages() {
        if(in_array($this->extension, $this->tableau_extensions)) {

            if($this->image_size <= $this->size) {

                if($this->image_error == 0) {

                    $generate_name = uniqid("img-user-", true);
                    // pour générer img-user-63c6cc4e6e1d91.28889735

                    $generate_result = $generate_name . "." . $this->extension;
                    // pour générer img-user-63c6cc4e6e1d91.28889735.extension de l'image

                    $parent = "../Public/ressources/pictures_users/$generate_result";
                    move_uploaded_file($this->image_tmpname, $parent);
                    unlink("../Public/ressources/pictures_users/$this->old_image");

                    UserModel::updateProfile($this->name, $this->email, $this->id);
                    UserModel::updateImage($generate_result, $this->id);
                    UserModel::updatePass($this->confirm_pass, $this->id);

                    $_SESSION['user_name']= $this->name;
                    $_SESSION['user_email']= $this->email;
                    $_SESSION['user_image']= $generate_result;

                    header("Location:/update");
                    exit();
                } else {
                    echo "<script> alert('Image non pris en charge') </script>";
                    header("Location:/update");
                    exit();
                }
            } else {
                echo "<script> alert('La aille de l\'image est trop grande') </script>";
                header("Location:/update");
                exit();
            }
        } else {
            $msg = "Insérer une image ou modifier le format de l\'image";
            header("Location:/update");
            exit();
        }
    }

}
