<?php
namespace App\Models;
use App\Controllers\Connexion;
use App\Controllers\CardController;
use PDO;

class ContactModel {

    public static function sendMessage($name, $email, $number, $msg){

        $connexion = new Connexion();
        $conn = $connexion->connect();

        $insert_message = $conn->prepare("INSERT INTO `message`( name, email, number, message) VALUES(?,?,?,?)");
        $insert_message->execute([$name, $email, $number, $msg]);

    }

    public static function selectMessage($name, $email, $number, $msg){

        $connexion = new Connexion();
        $conn = $connexion->connect();

        $select_message = $conn->prepare("SELECT * FROM `message` WHERE name = ? AND email = ? AND number = ? AND message = ?");
        $select_message->execute([$name, $email, $number, $msg]);

    }
}