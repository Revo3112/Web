<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password'];

    public function login($username, $password)
    {
        // Query database with parameter binding to prevent SQL Injection
        $query = $this->db->query("SELECT * FROM users WHERE username = ?", [$username]);

        // Get result as object array
        $result = $query->getRow();
        if ($result) {
            // Verify password
            if (password_verify($password, $result->password)) {
                // Set session data
                $sess_data = [
                    'id' => $result->id,
                    'name' => $result->username,
                    'role' => $result->role,
                    'logged_in' => TRUE
                ];
                session()->set($sess_data);
                return true;
            }
        }
        return false;
    }

    public function signup($username, $password)
    {
        // Membuat data yang akan disisipkan
        $data = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        // Menyisipkan data ke dalam tabel 'users'
        $inserted = $this->insert($data);

        // Mengembalikan hasil operasi penyisipan
        return $inserted;
    }


    public function logout()
    {
        // Destroy session
        session()->destroy();
    }

    public function is_logged_in()
    {
        // Check if logged in
        return session()->get('logged_in');
    }

    public function get_user()
    {
        // Get user data
        return session()->get();
    }
}
