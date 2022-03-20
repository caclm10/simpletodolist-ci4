<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class Profile extends BaseController
{
    public function edit()
    {
        $back = redirect()->to('/todo')->withInput();

        $isValid = $this->validate([
            'name' => 'required|max_length[70]',
            'password' => 'permit_empty|min_length[4]|max_length[16]',
        ]);

        if (!$isValid) return $back->with('errors-profile', $this->validator->getErrors());

        $inputData = (object) $this->request->getPost();
        $userModel = new User();

        $dataToSave = [
            'user_id' => auth_id(),
            'user_name' => $inputData->name,
        ];

        if ($inputData->password) $dataToSave['password'] = password_hash($inputData->password, PASSWORD_BCRYPT);

        $isSaved = $userModel->save($dataToSave);

        if (!$isSaved) return $back->with('error', 'Something went wrong when updating your account data, please try again later.');

        return redirect()->to('/todo')->with('success', 'Your profile has been updated successfully');
    }
}
