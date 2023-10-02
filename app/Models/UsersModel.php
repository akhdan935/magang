<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['type', 'username', 'password'];

    public function getUsers($key = false)
    {
        if($key == false){
            return $this->orderBy('username', 'ASC')->findAll();
        }

        return $this->where(['id' => $key])->orWhere(['username' => $key])->first();
    }

    public function getByUsername($username){
        return $this->where(['username' => $username])->first();
    }

    public function searchUsers($keyword)
    {
        return $this->table($this->table)->like('username', $keyword)->orLike('type', $keyword)->orderBy('username', 'ASC');
    }
}