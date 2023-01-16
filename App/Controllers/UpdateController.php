<?php
namespace App\Controllers;
use App\Models\UserModel;

class UpdateController {

   

    public static function updateProfile(){
        session_start();


        if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        }else{
        $user_id = '';
        };
        
        
        if(isset($_POST['update_profile'])){
        
        $user_id = $_SESSION['user_id'];
        
        if(!isset($user_id)){
            header('location:/login');
        };
        

        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        
        $update_profil = UserModel::updateProfile($name, $email, $user_id);
        
        $image = $_FILES['image']['name'];
        $image = htmlspecialchars($image);
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        // echo "<pre>";
        // print_r($image_tmp_name);
        // echo "<pre>";
        // exit();
        $image_folder = './ressources/uploaded_img/'.$image;
        $old_image = $_POST['old_image'];
        
        if(!empty($image)){
            if($image_size > 5000000){
                $message[] = 'La taille de l\'image est trop grande!';
            }else{
                $update_image = UserModel::updateImage($image, $user_id);
                if($update_image){
                    move_uploaded_file($image_tmp_name, $image_folder);
                    unlink('../ressources/uploaded_img/'.$old_image);
                    $message[] = 'Image mise à jour avec succès';
                };
            };
        };
        
        $old_pass = $_POST['old_pass'];
        $update_pass = password_hash($_POST['update_pass'], PASSWORD_BCRYPT);
        $new_pass = password_hash($_POST['new_pass'], PASSWORD_BCRYPT);
        $confirm_pass = password_hash($_POST['confirm_pass'], PASSWORD_BCRYPT);
        
        
        if(!empty($update_pass) AND !empty($new_pass) AND !empty($confirm_pass)){
            if($update_pass != $old_pass){
                $message[] = 'Ancien mot de passe incorrect';
            }elseif($new_pass != $confirm_pass){
                $message[] = 'Mot de passe de confirmation incorrect';
            }else{
                $updatePass = UserModel::updatePass($confirm_pass, $user_id);
                $message[] = 'Mot de passe mise à jour avec succès!';
            }
        }
        
        }
    }
}
