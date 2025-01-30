<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\CsrfTokenModel;
use Config\Services;

class CsrfAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $authHeader = $request->getHeaderLine('Authorization');
        if (empty($authHeader)) {
            return Services::response()->setJSON([
                'status' => 'error',
                'message' => 'Missing Authorization header.',
            ])->setStatusCode(401);
        }

        $csrfToken = trim(str_replace('Bearer', '', $authHeader));
        $csrfTokenModel = new CsrfTokenModel();

        $tokenRecord = $csrfTokenModel->findByToken($csrfToken);
        if (!$tokenRecord) {
            return Services::response()->setJSON([
                'status' => 'error',
                'message' => 'Invalid or expired token.',
            ])->setStatusCode(403);
        }

        // Optional: Check token expiration (1 hour)
        $expirationTime = strtotime($tokenRecord['created_at']) + 3600;
        if (time() > $expirationTime) {
            return Services::response()->setJSON([
                'status' => 'error',
                'message' => 'Token expired.',
            ])->setStatusCode(403);
        }

        return true;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Optional post-request logic
    }
}
