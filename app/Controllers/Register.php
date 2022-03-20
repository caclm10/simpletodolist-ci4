<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class Register extends BaseController
{
    public function index()
    {
        $errors = session('errors');

        return view('register', [
            'errors' => (object) $errors
        ]);
    }

    public function create()
    {
        $isValid = $this->validate([
            'name' => 'required|max_length[70]',
            'password' => 'required|min_length[4]|max_length[16]',
            'email'    => 'required|valid_email|is_unique[users.email]',
        ], [
            'email' => [
                'is_unique' => 'Email has already been taken',
            ]
        ]);

        $back = redirect()->to('/register')->withInput();

        if (!$isValid) return $back->with('errors', $this->validator->getErrors());

        $inputData = (object) $this->request->getPost();

        $userModel = new User();

        $isSaved = $userModel->save([
            'user_name' => $inputData->name,
            'email' => $inputData->email,
            'password' => password_hash($inputData->password, PASSWORD_BCRYPT),
        ]);

        if (!$isSaved) return $back->with('error', 'Something went wrong when creating your account, please try again later.');

        auth_login($inputData->email);

        return redirect()->to('/');
    }
}
