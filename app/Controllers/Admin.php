<?php

namespace App\Controllers;

class Admin extends BaseController
{

    protected $admin;

    public function __construct()
    {
        $this->admin = new  \App\Models\AdminModel();
    }

    public function index()
    {
        $islogin = session()->get('logged_in');
        if (!$islogin) {
            return redirect()->to('login');
        }

        // Ambil semua artikel dari database
        $allArticles = $this->admin->readArticles();

        // Inisialisasi array untuk menyimpan artikel berdasarkan ID pengguna
        $articlesByUser = [];
        // Memisahkan artikel berdasarkan ID pengguna
        foreach ($allArticles as $article) {
            $userId = $article['user_id'];
            if (!isset($articlesByUser[$userId])) {
                $articlesByUser[$userId] = [];
            }
            $articlesByUser[$userId][] = $article;
        }

        // dd($articlesByUser);

        // Data yang akan dikirimkan ke view
        $data = [
            'dataUser' => $this->admin->getUser(), // Mengambil semua pengguna
            'articlesByUser' => $articlesByUser,
        ];

        return view('admin', $data);
    }
}
