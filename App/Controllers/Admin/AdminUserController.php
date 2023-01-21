<?php
namespace App\Controllers;
use App\Models\UserModel;

class AdminUserController extends UserModel {


    public static function selectAllUsers(){

       return parent::select_all_users();
    }
}

