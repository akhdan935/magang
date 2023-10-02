<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Presence extends Migration
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
            'image_slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'is_unique' => true
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at' => [
                'type'       => 'DATETIME'
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('presence');
    }

    public function down()
    {
        $this->forge->dropTable('presence');
    }
}
