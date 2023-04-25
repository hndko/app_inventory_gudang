<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kategoris extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kat_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kat_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
        ]);
        $this->forge->addKey('kat_id', true);
        $this->forge->createTable('kategoris');
    }

    public function down()
    {
        $this->forge->dropTable('kategoris');
    }
}
