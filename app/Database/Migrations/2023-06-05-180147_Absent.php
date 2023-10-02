<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Absent extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => 100
            ],
            'explanation' => [
                'type'       => 'TEXT'
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'is_unique' => true
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255
            ],
            'days' => [
                'type'       => 'INT',
                'constraint' => 5
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('absent');
    }

    public function down()
    {
        $this->forge->dropTable('absent');
    }
}
