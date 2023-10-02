<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Folder extends Seeder
{
    public function run()
    {
        $date = strtotime("2022-12-01");
        for($i = 1;$i <= 37;$i++){
            $name = date('D, d M Y', $date);
            $segment = date('Y/m/d', $date);
            $date = date('Y-m-d', $date);
            $data[$i] = [
                'name' => $name,
                'segment' => $segment,
                'date' => $date
            ];
            $date = strtotime("+1 day " . $date);
        }

        foreach($data as $dt){
            $this->db->table('Folder')->insert($dt);
        }
    }
}
