<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Barangmasuk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'brgm_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'brgm_faktur' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'brgm_tgl_faktur' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'brgm_total_harga' => [
                'type' => 'DOUBLE',
            ],
        ]);
        $this->forge->addKey('brgm_id', true);
        $this->forge->createTable('barang_masuk');
    }

    public function down()
    {
        $this->forge->dropTable('barang_masuk');
    }
}
