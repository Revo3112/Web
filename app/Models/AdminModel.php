<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'published',
        'title',
        'script',
        'category_id',
    ];

    public function getUser()
    {
        // Query database with parameter binding to prevent SQL Injection
        $query = $this->db->query("SELECT id, username, created_at, last_active FROM users WHERE role = 'User'");
        return $query->getResultArray();
    }

    public function readArticles()
    {
        $builder = $this->db->table('articles');
        $builder->select('articles.user_id AS user_id, articles.id AS article_id, articles.published AS published_date, articles.title AS article_title, articles.script AS article_script, users.username, categories.category_name');
        $builder->join('users', 'articles.user_id = users.id');
        $builder->join('categories', 'articles.category_id = categories.id');
        $builder->where('users.role', 'User');

        $query = $builder->get();

        // Get the result array
        $result = $query->getResultArray();

        return $result;
    }
}
