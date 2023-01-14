<?php

namespace App\Controllers;
use App\Models\ContactModel;

class ContactController{

    public static function sendMessage(){


        if(isset($_POST['send'])){
   

            $name = $_POST['name'];
            $name = htmlspecialchars($name);
            $email = $_POST['email'];
            $email = htmlspecialchars($email);
            $number = $_POST['number'];
            $number = htmlspecialchars($number);
            $msg = $_POST['msg'];
            $msg = nl2br(htmlspecialchars($msg));
         
            $select_message = ContactModel::selectMessage($name, $email, $number, $msg);

            if(isset($select_message) && $select_message->rowCount() > 0){
               $message[] = '
               Message déjà envoyé !';
            }else{
         
                $insertMessage = ContactModel::sendMessage($name, $email, $number, $msg);
         
               $message[] = 'Message envoyé avec succès !';
               header("Location:/contact");
               
         
            }
         
         }

        

       

    } 
}