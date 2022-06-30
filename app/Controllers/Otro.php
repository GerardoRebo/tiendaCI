<?php

namespace App\Controllers;

use CodeIgniter\Shield\Models\UserModel;

class Otro extends BaseController
{
    public function index()
    {
        $users = new UserModel();
        $usrs=$users->asArray()->findAll();
    //    return $usrs['status']; 
        return dd($usrs[]);
        // var_dump($usrs);

    }
}