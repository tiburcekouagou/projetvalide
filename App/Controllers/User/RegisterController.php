<?php
namespace App\Controllers;
use App\Models\UserModel;



class RegisterController {

    /**
     * $usermodel
     */
    public $usermodel;

    public $name;
    public $email;
    public $pass;
    public $cpass;

    // public function __construct($name, $email, $pass, $cpass) {
    //     $this->name = $this->sanitaze($name);
    //     $this->email = $email;
    //     $this->pass = $pass;
    //     $this->cpass = $cpass;
      
    // }
    
    /**
     * sanitaze()
     */
    public function sanitaze($data) {
        $reg = preg_replace("/\s+/", " ", $data);

        $reg = preg_replace("/^\s*/", "", $reg);
        $data = $reg;
        return $data;
    }

    /**
     * verifyControl()
     */
    public function verifyControl() {
    $this->usermodel = new UserModel();
      $res = $this->usermodel->verify($this->email);
      $count = count($res);
       if($count>0) {
        header("Location:/register?msg=UserExistant&name=$this->name");
        exit();
        } 
        else {
            $insert = $this->usermodel->insertUser($this->name,  $this->email, $this->pass);
            header("Location:/login");
               exit();
        }
    }

    public function emptyInputs() {

        if(empty($this->name) || empty($this->email) || empty($this->pass) || empty($this->cpass)){
            header("Location:/register?msg=ChampsVide&name=$this->name&email=$this->email");
            exit();
        } 
            else{
            return false;
        }

    }

    /**
     * verifyPassword()
     */
    public function verifyPassword() {
        
        if ($this->pass !== $this->cpass) {
            header("Location:/register?msg=MotDePasseNonIdentique&name=$this->name&email=$this->email");
            exit();
       } 
       return false;

    }

    /**
     * verifyEmail()
     */
    public function verifyEmail() {

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            header("Location:/register?msg=CeUtilisateur ExisteD
            éja&firstname=$this->name");
            exit();
        }
        return false;
        
    }
    
    /**
     * getting()
     */
    public function getting() {

        
        if($_SERVER["REQUEST_METHOD"] === "POST" & isset($_POST["submit"])) {

            $name = $_POST["name"];
            $email = $_POST["email"];
            $pass = $_POST["pass"];
            $cpass = $_POST["cpass"];
            
            $this->name = $name;
            $this->email = $email;
            $this->pass = $pass;
            $this->cpass = $cpass;
            
            
            // $controller = new Controller($name, $email, $pass, $cpass);
            $this->verifyPassword();
            $this->verifyEmail();
        $this->emptyInputs();
        $this->verifyControl();
        } 
        else {
            header("Location:/register.php?msg=error");
            exit();
        }
    }

    
}