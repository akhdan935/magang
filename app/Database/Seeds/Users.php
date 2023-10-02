<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
    public function run()
    {
        $data = [
            [
            'type'    => 'admin',
            'username' => 'admin',
            'password'    => password_hash('123', PASSWORD_DEFAULT)
            ],
            [
            'type'    => 'user',
            'username' => 'user1',
            'password'    => password_hash('111', PASSWORD_DEFAULT)
            ],
            [
            'type'    => 'user',
            'username' => 'user2',
            'password'    => password_hash('222', PASSWORD_DEFAULT)
            ]
        ];
        foreach($data as $dt){
            $this->db->table('users')->insert($dt);
        }
    }
}
