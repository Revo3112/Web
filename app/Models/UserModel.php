<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $allowedFields = [
        'id',
        'user_id',
        'published',
        'title',
        'script',
        'category_id',
    ];

    public function getUserArticles($user_id = 1, $article_id = 0)
    {
        $this->table = 'articles';

        if ($article_id == 0) {
            return $this->where(['user_id' => $user_id])->findAll();
        }
        return $this->where(['user_id' => $user_id, 'id' => $article_id])->findAll();
    }

    public function insertUserArticles($data)
    {
        $this->table = 'articles';

        $currentTimestamp = date('Y-m-d H:i:s');

        $data = [
            'user_id' => $data['user_id'],
            'category_id' => '1',
            'published' => $currentTimestamp,
            'script' => $data['content'],
            'title' => $data['title'],
        ];

        return $this->insert($data);
    }

    public function editUserArticles($data)
    {
        $this->table = 'articles';

        $dataUpdate = [
            'category_id' => '1',
            'script' => $data['content'],
            'title' => $data['title'],
        ];

        $this->where(['user_id' => $data['user_id'], 'id' => $data['article_id']]);

        $this->set($dataUpdate);

        return $this->update();
    }

    public function deleteUserArticles($user_id, $article_id)
    {
        $this->table = 'articles';

        $this->where(['user_id' => $user_id, 'id' => $article_id]);

        return $this->delete();
    }
}
