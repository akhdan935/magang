<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class NoAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if(session()->get('username_account')){
            return redirect()->to('auth/success');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}