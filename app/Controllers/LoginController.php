<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends BaseController
{
    public function index()
    {
        // Load the login view
        return view('create/login');
    }

  public function authenticate()
{
    $session = session();
    $userModel = new UserModel();

    $email = $this->request->getVar('email');
    $password = $this->request->getVar('password');

    // Fetch user by email
    $user = $userModel->where('email', $email)->first();

    if (is_null($user)) {
        // User does not exist, return with error
        return redirect()->back()->withInput()->with('error', 'Invalid email or password.');
    }

    // Verify password
    if ($password !== $user['password']) {
        // Password does not match, return with error
        return redirect()->back()->withInput()->with('error', 'Invalid email password.');
    }

    // Set session data
    $ses_data = [
        'id' => $user['id'],
        'email' => $user['email'],
        'password' => $user['password'],
        'isLoggedIn' => TRUE,
        'role' => $user['role'] // Include role if role-based redirection is needed
    ];
    $session->set($ses_data);

    // Redirect based on user role
    if ($user['role'] === 'admin') {
        return redirect()->to('/admin/dashboard');
    }

    return redirect()->to('user/dashboard');
}




}
