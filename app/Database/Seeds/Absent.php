<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Provider\Lorem;

class Absent extends Seeder
{
    public function run()
    {
        $date = strtotime("2023-01-07");
        for($i = 1;$i <= 4;$i++){
            $date = date('Y-m-d', $date);
            $data[$i] = [
                'username' => 'user2',
                'explanation' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facere minima id, modi voluptatibus atque aspernatur officia excepturi harum nam hic alias ad velit blanditiis eligendi consequatur! Iste sed sapiente modi.'  ,
                'slug' => 'sick_' . $date . '_to_' . $date,
                'image' => '-' . ' ' . '(' . $i . ')' . '.jpg',
                'days' => 1
            ];
            $date = strtotime("+1 day " . $date);
        }

        foreach($data as $dt){
            $this->db->table('absent')->insert($dt);
        }
    }
}