<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Satuan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'sat_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'sat_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
        ]);
        $this->forge->addKey('sat_id', true);
        $this->forge->createTable('satuans');
    }

    public function down()
    {
        $this->forge->dropTable('satuans');
    }
}
