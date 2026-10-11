<?php

namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $data['user'] = $userModel->getDemoUser();

        return view('profile', $data);
    }
}
