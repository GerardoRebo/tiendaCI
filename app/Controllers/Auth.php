<?php

namespace App\Controllers;

use CodeIgniter\Shield\Models\UserModel;

class Auth extends BaseController
{

    public function login()
    {
        $validation = $this->validate([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]|max_length[12]',
        ]);
        if (!$validation) {
            return $this->validator->getErrors();
        } else {
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');

            $users = new UserModel();
            $user = $users->where('email', $email)->first();

            $exitoso = password_verify($password, $user->password);
            if (!$exitoso) {
                return "Credenciales Incorrectas";
            }
            $token = $user->generateAccessToken('Web');
            return $token->raw_token;
            return 'Exitoso';
        }
    }
    public function logout()
    {
        $user= auth()->user();
        $user->revokeAllAccessTokens();
        return "LoggedOut";
    }
    public function register()
    {
        $validation = $this->validate([
            'name' => 'required|min_length[6]|is_unique[users.email]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]|max_length[12]',
            'cpassword' => 'required|min_length[8]|max_length[12]|matches[password]',
        ]);
        if (!$validation) {
            return $this->validator->getErrors();
        } else {
            $name = $this->request->getVar('name');
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
            $cpassword = $this->request->getVar('cpassword');
            $values = [
                'username' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'cpassword' => $cpassword,
            ];
            $userModel = new UserModel();
            $query = $userModel->insert($values);
            return 'Exitoso';
        }
    }
}
