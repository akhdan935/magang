<?php

namespace App\Models;

use CodeIgniter\Model;

class FolderModel extends Model
{
    protected $table      = 'folder';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'segment', 'date'];

    public function getFolder($keyword = false)
    {
        if($keyword == false){
            return $this->orderBy('date', 'DESC')->findAll();
        }

        return $this->table($this->table)->like('name', $keyword)->orLike('segment', $keyword)->orLike('date', $keyword)->orderBy('date', 'DESC');
    }
}