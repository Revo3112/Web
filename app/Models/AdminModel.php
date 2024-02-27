<?php

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
        $query = $this->db->query("SELECT id, username FROM users WHERE role = 'User'");
        return $query->getResult();
    }

    public function readArticles($user_id)
    {
        $builder = $this->db->table('articles');
        $builder->select('articles.id AS article_id, articles.published AS published_date, articles.title AS article_title, users.username, categories.category_name');
        $builder->join('users', 'articles.user_id = users.id');
        $builder->join('categories', 'articles.category_id = categories.id');
        $builder->where('articles.user_id', $user_id);
        $builder->where('users.role', 'User');

        $query = $builder->get();

        // Get the result array
        $result = $query->getResultArray();

        dd($result);

        return $result;
    }
}
