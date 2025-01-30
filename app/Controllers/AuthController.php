<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use App\Models\CsrfTokenModel;

class AuthController extends ResourceController
{
    public function login()
    {
        $userModel = new UserModel();
        $csrfTokenModel = new CsrfTokenModel();
        $request = $this->request;

        // Get JSON data from the request body
        $data = $request->getJSON();

        if (!$data || !isset($data->username) || !isset($data->password)) {
            return $this->respond([
                'status' => 'error',
                'message' => 'Invalid request data',
            ], 400);
        }

        $username = $data->username;
        $password = $data->password;

        // Fetch user from the model
        $user = $userModel->findByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            // Generate CSRF token
            $csrfToken = bin2hex(random_bytes(32));

            // Save the token using the model
            $csrfTokenModel->save([
                'user_id' => $user['id'],
                'token' => $csrfToken,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            // Return the token in the response
            return $this->respond([
                'status' => 'success',
                'message' => 'Login successful',
                'csrf_token' => $csrfToken,
            ], 200);
        }

        return $this->respond([
            'status' => 'error',
            'message' => 'Invalid username or password',
        ], 401);
    }
}
