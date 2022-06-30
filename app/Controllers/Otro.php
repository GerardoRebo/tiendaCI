<?php

namespace App\Controllers;

use CodeIgniter\Shield\Models\UserModel;

class Otro extends BaseController
{
   
    public function index()
    {
        // return "ahuevo puto";
        return json_encode("ahuvo");
        // $users = new UserModel();
        // $user = $users->findById(1);
        // $user->revokeAllAccessTokens();
        // $user->revokeAccessToken('d71bb2ddb267c60049abd5b21b34a730da63f52fff297862585a0b147c603b56');
        // return $usrs;

    }
}
