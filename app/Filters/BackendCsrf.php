<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class BackendCsrf implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        config('Security')->regenerate = false;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $response->setHeader(
            config('Security')->headerName,
            csrf_hash()
        );
    }
}