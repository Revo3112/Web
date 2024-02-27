<?php

use App\Controllers\BaseController;

class Admin extends BaseController
{

    protected $admin;

    public function __construct()
    {
        $this->admin = new  AdminModel;
    }

    public function index()
    {
        $islogin = session()->get('logged_in');
        if (!$islogin) {
            return redirect()->to('login');
        }

        $data = [
            'dataUser' => $this->admin->getUser(session()->get('user_id')),
        ];

        return view('user', $data);
    }

    public function readArtciles()
    {
        $data = [
            'dataUser' => $this->admin->readArticles(session()->get('user_id')),
        ];
    }
}
