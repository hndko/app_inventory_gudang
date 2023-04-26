<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Barang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'brg_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'brg_nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'brg_kat_id' => [
                'type'       => 'INT',
                'constraint' => '11',
            ],
            'brg_sat_id' => [
                'type'       => 'INT',
                'constraint' => '11',
            ],
            'brg_harga' => [
                'type'       => 'INT',
                'constraint' => '11',
            ],
            'brg_gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'brg_stok' => [
                'type'       => 'INT',
                'constraint' => '11',
            ],
        ]);
        $this->forge->addKey('brg_id', true);
        $this->forge->createTable('barangs');
    }

    public function down()
    {
        $this->forge->dropTable('barangs');
    }
}
