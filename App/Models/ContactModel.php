<?php
namespace App\Models;
use Core\Connexion;
use PDO;

class ContactModel extends Connexion{
    
    
    public static function sendMessage($name, $email, $number, $msg){
        $conn = parent::connect();

        $insert_message = $conn->prepare("INSERT INTO `shop_db`.message ( name, email, number, message) VALUES(?,?,?,?)");
        $insert_message->execute([$name, $email, $number, $msg]);

    }

    public static function selectMessage($name, $email, $number, $msg){

        $conn = parent::connect();

        $select_message = $conn->prepare("SELECT * FROM `shop_db`.message WHERE name = ? AND email = ? AND number = ? AND message = ?");
        $select_message->execute([$name, $email, $number, $msg]);

    }

    public static function selectAllMessage(){
        $conn = parent::connect();

        $select_message = $conn->prepare("SELECT * FROM `message`");
        $select_message->execute();
        if($select_message->rowCount() > 0){
         $fetch_message = $select_message->fetchAll(PDO::FETCH_ASSOC);
         return $fetch_message;
        }
    } 


    public static function numberOfMessages(){

        $conn = parent::connect();

        $select_messages = $conn->prepare("SELECT * FROM `message`");
        $select_messages->execute();
        $number_of_messages = $select_messages->rowCount();
        return $number_of_messages;

    }

    public static function delete_message($delete_id){

        $conn = parent::connect();
       
        $delete_message = $conn->prepare("DELETE FROM `message` WHERE id = ?");
        $delete_message->execute([$delete_id]);
    }
}