<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'dataUser' => $this->userModel->getUserArticles(1),
            'user_id' => 1,
        ];

        // if (empty($data['dataUser'])) {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException('Data artikel tidak ditemukan!');
        // }

        return view('user', $data);
    }

    public function addArticle()
    {
        $data = [
            'user_id' => 1,
        ];
        return view('article', $data);
    }

    public function editArticle()
    {
        $data = [
            'user_id' => $this->request->getVar('user_id'),
            'article_id' => $this->request->getVar('article_id'),
            'title' => $this->request->getVar('title'),
            'content' => $this->request->getVar('content'),
        ];

        return view('article', $data);
    }

    public function deleteArticle($user_id, $article_id)
    {
        if ($this->userModel->deleteUserArticles($user_id, $article_id)) {
            session()->setFlashdata('success', 'Artikel berhasil dihapus!');

            return redirect()->to('user');
        } else {
            session()->setFlashdata('failed', 'Artikel gagal dihapus!');

            return redirect()->to('user');
        }
    }

    public function saveArticle()
    {

        $role = session()->get('role');
        $article_id = $this->request->getVar('article_id');

        if (empty($article_id)) {
            if ($this->userModel->insertUserArticles([
                'user_id' => $this->request->getVar('user_id'),
                'title' => $this->request->getVar('title'),
                'content' => $this->request->getVar('content'),
            ])) {
                session()->setFlashdata('success', 'Artikel berhasil ditambahkan!');

                if ($role == 'Admin') {
                    return redirect()->to('admin');
                }
                return redirect()->to('user');
            } else {
                session()->setFlashdata('failed', 'Artikel gagal ditambahkan!');
                if ($role == 'Admin') {
                    return redirect()->to('admin');
                }
                return redirect()->to('user');
            }
        } else {
            if ($this->userModel->editUserArticles([
                'user_id' => $this->request->getVar('user_id'),
                'article_id' => $this->request->getVar('article_id'),
                'title' => $this->request->getVar('title'),
                'content' => $this->request->getVar('content'),
            ])) {
                session()->setFlashdata('success', 'Artikel berhasil diedit!');
                if ($role == 'Admin') {
                    return redirect()->to('admin');
                }
                return redirect()->to('user');
            } else {
                session()->setFlashdata('failed', 'Artikel gagal diedit!');
                if ($role == 'Admin') {
                    return redirect()->to('admin');
                }
                return redirect()->to('user');
            }
        }
    }
}
