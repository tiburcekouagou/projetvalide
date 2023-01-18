<?php
namespace App\Models;
use App\Controllers\Connexion;

class ContactModel {

    public static function sendMessage($name, $email, $number, $msg){

        $connexion = new Connexion();
        $conn = $connexion->connect();

        $insert_message = $conn->prepare("INSERT INTO `shop_db`.message ( name, email, number, message) VALUES(?,?,?,?)");
        $insert_message->execute([$name, $email, $number, $msg]);

    }

    public static function selectMessage($name, $email, $number, $msg){

        $connexion = new Connexion();
        $conn = $connexion->connect();

        $select_message = $conn->prepare("SELECT * FROM `shop_db`.message WHERE name = ? AND email = ? AND number = ? AND message = ?");
        $select_message->execute([$name, $email, $number, $msg]);

    }

    public static function numberOfMessages(){

        $connexion = new Connexion();
        $conn = $connexion->connect();

        $select_messages = $conn->prepare("SELECT * FROM `message`");
        $select_messages->execute();
        $number_of_messages = $select_messages->rowCount();
        return $number_of_messages;

    }
}