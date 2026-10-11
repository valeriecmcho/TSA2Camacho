<?php

namespace App\Controllers;

use App\Models\UserModel;

/**
 * Auth controller – handles login and logout.
 */
class Auth extends BaseController
{
    // GET /login and GET /
    public function loginForm()
    {
        // Already logged in? Go home.
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('home'));
        }
        return view('login');
    }

    // POST /login and POST /
    public function loginAction()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if (empty($username) || empty($password)) {
            return redirect()->back()->with('error', 'Username and password are required.');
        }

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if (! $user || ! password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Invalid username or password.');
        }

        // Store user info in session
        session()->set([
            'logged_in' => true,
            'user_id'   => $user['id'],
            'username'  => $user['username'],
            'full_name' => $user['full_name'],
        ]);

        return redirect()->to(base_url('home'))->with('success', 'Welcome back, ' . $user['full_name'] . '!');
    }

    // POST /logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'))->with('success', 'You have been logged out.');
    }
}
