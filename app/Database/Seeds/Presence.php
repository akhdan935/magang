<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Presence extends Seeder
{
    public function run()
    {
        $date = "2022-12-01";
        for($i = 1;$i <= 32;$i++){
            $data[$i] = [
                'username' => 'user1',
                'image_slug' => 'depart_user1_'.$date,
                'image' => '-' . ' ' . '(' . $i . ')' . '.jpg',
                'created_at' => $date
            ];
            $date = strtotime("+1 day " . $date);
            $date = date('Y-m-d', $date);
        }
        $date = "2022-12-01";
        for($i = 33;$i <= 64;$i++){
            $data[$i] = [
                'username' => 'user1',
                'image_slug' => 'return_user1_'.$date,
                'image' => '-' . ' ' . '(' . $i . ')' . '.jpg',
                'created_at' => $date
            ];
            $date = strtotime("+1 day " . $date);
            $date = date('Y-m-d', $date);
        }

        $date = "2023-01-01";
        for($i = 65;$i <= 70;$i++){
            $data[$i] = [
                'username' => 'user2',
                'image_slug' => 'depart_user2_'.$date,
                'image' => '-' . ' ' . '(' . $i . ')' . '.jpg',
                'created_at' => $date
            ];
            $date = strtotime("+1 day " . $date);
            $date = date('Y-m-d', $date);
        }
        $date = "2023-01-01";
        for($i = 71;$i <= 76;$i++){
            $data[$i] = [
                'username' => 'user2',
                'image_slug' => 'return_user2_'.$date,
                'image' => '-' . ' ' . '(' . $i . ')' . '.jpg',
                'created_at' => $date
            ];
            $date = strtotime("+1 day " . $date);
            $date = date('Y-m-d', $date);
        }

        foreach($data as $dt){
            $this->db->table('presence')->insert($dt);
        }
    }
}
