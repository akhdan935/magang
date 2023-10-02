<?php

namespace App\Models;

use CodeIgniter\Model;

class PresenceModel extends Model
{
    protected $table      = 'presence';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'image_slug', 'image'];
    protected $useTimestamps = true;
    protected $updatedField  = '';
    protected $deletedField  = '';

    public function myValidate($slug)
    {
        $data = $this->where('image_slug', $slug)->first();
        if($data){
            return true;
        } else {
            return false;
        }
    }

    public function check($date, $username)
    {
        $data = $this->where('username', $username)->like('image_slug', $date)->first();
        if($data){
            return true;
        } else {
            return false;
        }
    }

    public function getByUsername($username)
    {
        return $this->table($this->table)->where(['username' => $username]);
    }

    public function getByDate($username, $date)
    {
        return $this->where(['username' => $username])->like('created_at', $date)->findAll();
    }

    public function getPresence($keyword, $date)
    {
        return $this->table($this->table)->like('created_at', $date)->like('image_slug', $keyword);
    }
}