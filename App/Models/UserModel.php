<?php
namespace App\Models;
use Core\Connexion;
use PDO;


/**
 * 
 */
class UserModel extends Connexion {

    /**
     * $conn
     */
    public $connection;

    public $id;
    public $name;
    public $email;
    public $pass;

    /**
     * verify()
     */
    public function verify($email) {
        $this->email = $email;

        /**
         * 
         */
        $connection = $this->connect();
        /**
         * $request
         */
        $request = "SELECT * FROM `shop_db`.users WHERE email = ?;";
        /**
         * $inst
         */
        $inst = $connection->prepare($request);
        $inst->execute([$this->email]);
        $result = $inst->fetchAll();
        return $result;
    }

    /**
     * verify()
     */
    public function verifyId($id) {
        $this->id = $id;

        /**
         * 
         */
        $connection = $this->connect();
        /**
         * $request
         */
        $request = "SELECT * FROM `shop_db`.users WHERE id = ?;";
        /**
         * $inst
         */
        $inst = $connection->prepare($request);
        $inst->execute([$this->id]);
        $result = $inst->fetchAll();
        return $result;
    }

    /**
     * insertUser()
     */
    public function insertUser($name, $email, $pass) {

        $connection = $this->connect();

        
        $this->name = $name;
        $this->email = $email;
        $this->pass = $pass;

        /**
         * $request
         */
        $request = "INSERT INTO `shop_db`.users VALUES(NULL, :name, :email, :pass, 'user', 'default-img.jpg')";
        
        $inst = $connection->prepare($request);
        $inst->execute([
            ":name" => $this->name,
            ":email" => $this->email,
            ":pass" => password_hash($this->pass, PASSWORD_DEFAULT) 
        ]);

    }


    public static function getUser(){

        $conn = parent::connect();
      
        $user_email = $_SESSION ['user_email'];
        

        $select_profile = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
        $select_profile->execute([$user_email]);

        if($select_profile->rowCount() > 0){
        $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            return $fetch_profile;
        }

        return false;
    }

 
    /**
     * updateImage(), met à jour l'image;
     */
    public static function updateImage($image, $user_id) {
         $conn = parent::connect();

        /**
         * $sql, pour les requêtes vers la base de données
         */
        $sql = "UPDATE `users` SET image = ? WHERE id = ?";
        $update_image = $conn->prepare($sql);
        $update_image->execute([$image, $user_id]);

       
    }

    /**
     * updateImage(), met à jour l'image;
     */
    public static function updateProfile($name, $email, $user_id) {
         $conn = parent::connect();

        /**
         * $sql, pour les requêtes vers la base de données
         */
        $sql = "UPDATE `users` SET name = ?, email = ? WHERE id = ?";
        $update_profile = $conn->prepare($sql);
        $update_profile->execute([$name, $email, $user_id]);

       
    }

    /**
     * updateImage(), met à jour l'image;
     */
    public static function updatePass($confirm_pass, $user_id) {
         $conn = parent::connect();

        $confirm_pass = password_hash($confirm_pass, PASSWORD_DEFAULT);

        /**
         * $sql, pour les requêtes vers la base de données
         */
        $sql = "UPDATE `users` SET password = ? WHERE id = ?";
        $update_pass_query = $conn->prepare($sql);
        $update_pass_query->execute([$confirm_pass, $user_id]);

       
    }

    public function numberOfUsers(){

        $conn = parent::connect();

        $select_users = $conn->prepare("SELECT * FROM `users` WHERE user_type = ?");
         $select_users->execute(['user']);
         $number_of_users = $select_users->rowCount();
         return $number_of_users;
    }

    public function numberOfAdmins(){

        $conn = parent::connect();

        $select_admins = $conn->prepare("SELECT * FROM `users` WHERE user_type = ?");
         $select_admins->execute(['admin']);
         $number_of_admins = $select_admins->rowCount();
         return $number_of_admins;
    }

    public function numberOfAccounts(){

        $conn = parent::connect();

        $select_accounts = $conn->prepare("SELECT * FROM `users`");
         $select_accounts->execute();
         $number_of_accounts = $select_accounts->rowCount();
         return $number_of_accounts;
    }

    public static function select_all_users(){

        $conn = parent::connect();

        $select_users = $conn->prepare("SELECT * FROM `users`");
        $select_users->execute();
        if ($select_users->rowCount() > 0) {
            $fetch_users = $select_users->fetchAll(PDO::FETCH_ASSOC);
            return $fetch_users;
        }

    }
   
}

