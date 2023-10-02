<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
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
            'type' => [
                'type'       => 'ENUM',
                'constraint' => ['admin','user']
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'is_unique' => true
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
