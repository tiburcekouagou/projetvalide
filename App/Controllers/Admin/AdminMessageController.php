<?php
namespace App\Controllers;
use App\Models\ContactModel;


class AdminMessageController extends ContactModel{



    public static function selectAllMessage(){
        
        return parent::selectAllMessage();
    }

    public static function deleteMessage(){

        if(isset($_GET['delete'])){

            $delete_id = $_GET['delete'];
            return parent::delete_message($delete_id);
         }

    }


}