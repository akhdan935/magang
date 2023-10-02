<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsentModel extends Model
{
    protected $table      = 'absent';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'explanation', 'slug', 'image', 'days'];

    public function myValidate($slug)
    {
        $data = $this->where('slug', $slug)->first();
        if($data){
            return true;
        } else {
            return false;
        }
    }
    public function findHard($username, $date)
    {
        return $this->where('username', $username)->like('slug', 'sick_' . $date, 'after')->orLike('slug', 'permit_' . $date, 'after')->findAll();
    }
    public function search($keyword, $username)
    {
        return $this->table($this->table)->where(['username' => $username])->like('slug', $keyword);
    }
    public function searchByUsername($username)
    {
        return $this->table($this->table)->where(['username' => $username]);
    }
}