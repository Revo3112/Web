<?php

namespace App\Controllers;

class Auth extends BaseController
{
    // property
    protected $login;

    // constructor
    public function __construct()
    {
        $this->login = new \App\Models\AuthModel();
    }

    public function login_controller()
    {
        helper(['form']);

        $validation = \Config\Services::validation();

        $validation->setRules([
            'username' => 'required',
            'password' => 'required'
        ]);

        $login_button = $this->request->getPost('LOGIN');
        if ($login_button == null) {
            return redirect()->to('login');
        } else {
            // Get input from form
            if ($validation->withRequest($this->request)->run()) {
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');

                $success =  $this->login->login($username, $password);
                if ($success) {
                    $role = session()->get('role');
                    if ($role == 'Admin') {
                        return view('/admin');
                    } elseif ($role == 'User') {
                        return redirect()->to('/user');
                    }
                } else {
                    $validation->setError('login', 'Username or password is incorrect');
                    return view('login_page', ['validation' => $validation]);
                }
            } else {
                $data = [
                    'title' => 'Login',
                    'validation' => $validation
                ];
                return view('login_page', $data);
            }
        }
    }

    public function signup_controller()
    {
        helper(['form']);

        $validation = \Config\Services::validation();

        $validation->setRules([
            'username' => [
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'is_unique' => 'Username sudah ada. Silakan pilih yang lain.'
                ]
            ],
            'password' => 'required',
        ]);

        $signup_button = $this->request->getPost('SIGNUP');
        if ($signup_button == null) {
            return redirect()->to('signup');
        } else {
            // Get input from form
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            if ($validation->withRequest($this->request)->run()) {
                // Panggil fungsi signup dari model atau class yang sesuai
                $success = $this->login->signup($username, $password); // Menyesuaikan dengan fungsi signup yang ada
                if ($success) {
                    return redirect()->to('login');
                } else {
                    return redirect()->to('signup');
                }
            } else {
                // Menyiapkan data untuk ditampilkan kembali di halaman signup
                $data = [
                    'title' => 'Sign Up',
                    'validation' => $validation
                ];
                return view('signup_page', $data);
            }
        }
    }

    public function logout()
    {
        $this->login->logout();
    }
}
