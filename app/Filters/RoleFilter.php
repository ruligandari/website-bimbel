<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    /**
     * Check if user has the required role
     *
     * @param RequestInterface $request
     * @param array|null       $arguments - expects ['admin'] or ['guru']
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if user is logged in
        if (!session()->get('user_id')) {
            return redirect()->to('/');
        }

        // Get user role from session
        $userRole = session()->get('role');

        // If no arguments provided, just check if logged in
        if (empty($arguments)) {
            return;
        }

        // Check if user has required role
        // Arguments: ['admin'] means role must be 1
        // Arguments: ['guru'] means role must be 2
        $requiredRole = null;
        if (in_array('admin', $arguments)) {
            $requiredRole = 1;
        } elseif (in_array('guru', $arguments)) {
            $requiredRole = 2;
        }

        // If role doesn't match, redirect with error
        if ($requiredRole !== null && $userRole != $requiredRole) {
            session()->setFlashdata('error', 'Anda tidak memiliki akses ke halaman ini');
            return redirect()->to('/admin/dashboard');
        }

        return;
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
