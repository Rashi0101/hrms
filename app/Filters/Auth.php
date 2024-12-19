<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Services;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        // Check if the user is logged in
        if (! $session->get('isLoggedIn')) {
            log_message('debug', 'User is not logged in. Redirecting to login.');
            return redirect()->to('/login');
        }

        // If role-based redirection is needed, check for user role
        if (isset($arguments[0])) {
            // Check if the role is matching the user's session role
            if ($session->get('userRole') !== $arguments[0]) {
                log_message('debug', 'User does not have the correct role. Redirecting to login.');
                return redirect()->to('/login');
            }
        }

        log_message('debug', 'User is logged in. Proceeding to the requested page.');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after the response is sent
    }
}
