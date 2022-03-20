<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class Login extends BaseController
{
    public function index()
    {
        $errors = session('errors');

        return view('login', [
            'errors' => (object) $errors
        ]);
    }

    public function auth()
    {
        $back = redirect()->to('/login')->withInput();

        $isValid = $this->validate([
            'email'    => 'required|valid_email|is_not_unique[users.email]',
            'password' => "required|min_length[4]|max_length[16]",
        ], [
            'email' => [
                'is_not_unique' => 'Email not registered',
            ],
        ]);

        if (!$isValid) return $back->with('errors', $this->validator->getErrors());

        $inputData = (object) $this->request->getPost();

        $userModel = new User();
        $user = $userModel->where('email', $inputData->email)->first();

        if (!password_verify($inputData->password, $user->password)) return $back->with('errors', ['password' => 'Incorrect password']);

        auth_login($user->email);

        return redirect()->to('/todo');
    }
}
