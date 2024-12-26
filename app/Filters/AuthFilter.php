<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
public function before(RequestInterface $request, $arguments = null)
{
    // Pastikan jika pengguna belum login, arahkan ke halaman login
    $publicPages = ['middleware/login', 'middleware/register'];
    if (!session()->get('isLoggedIn') && !in_array($request->getPath(), $publicPages)) {
        return redirect()->to('/middleware/login');
    }
}

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak diperlukan tindakan setelah request
    }
}
