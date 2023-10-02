<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Folder extends Migration
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
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 50
            ],
            'segment' => [
                'type'       => 'VARCHAR',
                'constraint' => 50
            ],
            'date' => [
                'type'       => 'DATETIME',
                'is_unique' => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('folder');
    }

    public function down()
    {
        $this->forge->dropTable('folder');
    }
}
