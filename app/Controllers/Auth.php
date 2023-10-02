<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function __construct()
    {
        helper('cookie');
    }
    public function login()
    {
        if(get_cookie('cookie_username') && get_cookie('cookie_password')){
            $username = get_cookie('cookie_username');
            $password = get_cookie('cookie_password');

            $dataAccount = $this->usersModel->getUsers($username);
            if($password != $dataAccount['password']){
                $error = 'Your username or password is wrong';
                session()->setFlashdata('warning', $error);
                
                delete_cookie('cookie_username');
                delete_cookie('cookie_password');
                return redirect()->to('auth');
            }

            $session = [
                'username_account' => $dataAccount['username'],
                'type_account' => $dataAccount['type']
            ];

            session()->set($session);
            return redirect()->to('auth/success')->withCookies();
        }

        if($this->request->getMethod() == 'post'){
            if(!$this->validate([
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Username must be filled'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password must be filled'
                    ]
                ]
            ])){
                $validation = \Config\Services::validation();
                return redirect()->to('auth')->withInput()->with('validation', $validation);
            }

            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $rememberPassword = $this->request->getVar('rememberPassword');

            $dataAccount = $this->usersModel->getUsers($username);
            if(!password_verify($password, $dataAccount['password'])){
                $error = 'Your username or password is wrong';
                session()->setFlashdata('warning', $error);
                return redirect()->to('auth')->withInput();
            }

            if($rememberPassword == '1'){
                set_cookie('cookie_username', $username, 3600*24*30);
                set_cookie('cookie_password', $dataAccount['password'], 3600*24*30);
            }

            $session = [
                'username_account' => $dataAccount['username'],
                'type_account' => $dataAccount['type']
            ];

            session()->set($session);
            return redirect()->to('auth/success')->withCookies();
        }

        $data = [
            'validation' => session()->get('validation')
        ];

        return view('auth/login', $data);
    }
    public function logout()
    {
        delete_cookie('cookie_username');
        delete_cookie('cookie_password');
        session()->destroy();
        if(session()->get('username_account' == '') && session()->get('type_account' == '')){
            session()->setFlashdata('success', 'You have successfully logged out');
        }
        return view('auth/login');
    }
    public function success()
    {
        if(session()->get('type_account') == 'user'){
            return redirect()->to('user');
        } else if(session()->get('type_account') == 'admin'){
            return redirect()->to('admin');
        }
    }
}