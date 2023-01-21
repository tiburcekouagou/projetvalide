<?php
namespace App\Controllers;
use App\Models\UserModel;
use Core\View;

class LoginController {

    /**
     * $usermodel
     */
    public $usermodel;

    public $email;
    public $pass;

   

    /**
     * verifyControl()
     */
    public function verifyLoginControl() {
        $this->usermodel = new UserModel();
        $result = $this->usermodel->verify($this->email);
        $count = count($result);

       if($count>0) {
           $pass = password_verify($this->pass, $result[0]["password"]);

           if($pass === true & $result[0]["user_type"] === "admin") {
            //    session_start();
                $_SESSION['admin_id'] = $result[0]['id'];
                $_SESSION['role'] = $result[0]['user_type'];
                $connexion = ProfileController::getUser();
               header("Location:/");
               exit();
            } 

            elseif($pass === true & $result[0]["user_type"] !== "admin") {
                $_SESSION['role'] = $result[0]['user_type'];
                $connexion = ProfileController::getUser();

            
              
                // View::render("home.php");
                header("Location:/");
                exit();
            }

             else {
                // View::render("login.php",
                // [
                //     'message' => [
                //         'message'=> 'password_error',
                //         'email'=> $this->email,
                //     ]
                // ]);
                $message= 'password_error';
               
               header("Location:/login");
               exit();
           }
        } 
        else {
            header("Location:/login?msg=user_not_found&email=$this->email");
            exit();
        }
    }



    public function macth() {

        if($_SERVER["REQUEST_METHOD"] === "POST" & isset($_POST["submit"])) {
            $email = $_POST["email"];
            $pass = $_POST["pass"];

            session_start();
            $_SESSION ['user_email']= $email;


            $this->email = $email;
            $this->pass = $pass;
        
        $this->verifyLoginControl();
        } 
        else {
            header("Location:/login?msg=error");
            exit();
        }
    }


}