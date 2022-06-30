<?php

namespace App\Controllers;

use CodeIgniter\Shield\Models\UserModel;

class Auth extends BaseController
{

    public function login()
    {
        $users = new UserModel();
        $user = $users->findById(1);
        $token = $user->generateAccessToken('Work Laptop');
        return $token->raw_token;
        // $user->revokeAllAccessTokens();

        // $user->revokeAccessToken('d71bb2ddb267c60049abd5b21b34a730da63f52fff297862585a0b147c603b56');
        // return $usrs;

    }
    public function logout()
    {
        return json_encode("ahuvo");
        // $users = new UserModel();
        // $user = $users->findById(1);
        // $user->revokeAllAccessTokens();
        // $user->revokeAccessToken('d71bb2ddb267c60049abd5b21b34a730da63f52fff297862585a0b147c603b56');
        // return $usrs;

    }
    public function register()
    {
           $validation = $this->validate([
                'name'=> 'required|min_length[6]|is_unique[users.email]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[8]|max_length[12]',
                'cpassword' => 'required|min_length[8]|max_length[12]|matches[password]',
            ]);
            if (!$validation) {
                return $this->validator->getErrors();
            }else {
                $name = $this->request->getVar('name');
                $email = $this->request->getVar('email');
                $password = $this->request->getVar('password');
                $cpassword = $this->request->getVar('cpassword');
                $values = [
                    'username' => $name,
                    'email' => $email,
                    'password' => password_hash($password,PASSWORD_BCRYPT),
                    'cpassword' => $cpassword,
                ];
                $userModel = new UserModel();
                $query = $userModel->insert($values);
                return 'Exitoso';
            }
    }
}
