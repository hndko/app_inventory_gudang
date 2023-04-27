<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailBarangMasuk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'det_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'det_faktur' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'det_brg_kode' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'det_harga_masuk' => [
                'type' => 'DOUBLE',
            ],
            'det_harga_jual' => [
                'type' => 'DOUBLE',
            ],
            'det_jumlah' => [
                'type' => 'INT',
            ],
            'det_subtotal' => [
                'type' => 'DOUBLE',
            ],
        ]);
        $this->forge->addKey('det_id', true);
        $this->forge->createTable('detail_barang_masuk');
    }

    public function down()
    {
        $this->forge->dropTable('detail_barang_masuk');
    }
}
