<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class NoAuthAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if(session()->get('username_account')){
            if(session()->get('type_account') == 'admin'){
                return redirect()->to('admin');
            }
        } else {
            return redirect()->to('auth');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}