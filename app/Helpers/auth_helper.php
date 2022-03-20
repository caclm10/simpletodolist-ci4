<?php

use App\Models\User;

function auth_login(string $email)
{
    session()->set('auth_email', $email);
}

function auth_logout()
{
    session()->destroy();
}

function auth_check()
{
    return (bool) session('auth_email');
}

function auth_email()
{
    return session('auth_email');
}

function auth_user()
{
    $userModel = new User();

    return $userModel->where('email', auth_email())->first();
}

function auth_id()
{
    if (!auth_check()) return null;


    return auth_user()->id;
}
