<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        // return view('welcome_message');
        return view('home');
    }
    public function signup_page(): string
    {
        return view('signup_page');
    }
    public function login_page(): string
    {
        return view('login_page');
    }
    public function user(): string
    {
        return view('user');
    }
    public function user_article(): string
    {
        return view('user_article');
    }
    public function admin(): string
    {
        return view('admin');
    }
}
