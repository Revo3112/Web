<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'created_at', 'last_active'];

    public function login($username, $password)
    {
        // Set zona waktu ke waktu Indonesia (Waktu Indonesia Barat)
        date_default_timezone_set('Asia/Jakarta');

        // Query database with parameter binding to prevent SQL Injection
        $query = $this->db->query("SELECT * FROM users WHERE username = ?", [$username]);

        // Get result as object array
        $result = $query->getRow();
        if ($result) {
            // Verify password
            if (password_verify($password, $result->password)) {
                // Set session data
                $sess_data = [
                    'user_id' => $result->id,
                    'name' => $result->username,
                    'role' => $result->role,
                    'logged_in' => TRUE
                ];
                session()->set($sess_data);

                // Update last_active time
                $currentDateTime = date('Y-m-d H:i:s');
                $this->db->table('users')->where('id', $result->id)->update(['last_active' => $currentDateTime]);

                return true;
            }
        }
        return false;
    }


    public function signup($username, $password)
    {
        // Set zona waktu ke waktu Indonesia (Waktu Indonesia Barat)
        date_default_timezone_set('Asia/Jakarta');

        // Mendapatkan tanggal dan waktu saat ini
        $currentDateTime = date('Y-m-d H:i:s');

        // Membuat data yang akan disisipkan
        $data = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'created_at' => $currentDateTime,
            'last_active' => $currentDateTime // Diatur sama dengan waktu pembuatan untuk saat ini
        ];

        // Menyisipkan data ke dalam tabel 'users'
        $inserted = $this->insert($data);

        // Mengembalikan hasil operasi penyisipan
        return $inserted;
    }



    public function logout()
    {
        // Set zona waktu ke waktu Indonesia (Waktu Indonesia Barat)
        date_default_timezone_set('Asia/Jakarta');

        // Mendapatkan user ID dari sesi
        $userId = session()->get('user_id');

        // Mendapatkan tanggal dan waktu saat ini
        $currentDateTime = date('Y-m-d H:i:s');

        // Menyiapkan data untuk update
        $data = [
            'last_active' => $currentDateTime
        ];

        // Melakukan update pada kolom last_active untuk pengguna yang sedang logout
        $this->db->table('users')->where('id', $userId)->update($data);

        // Menghapus sesi
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
