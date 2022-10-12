<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PendaftaranKonsultasi extends Migration
{
    public function up()
    {
    $this->forge->addField([
        'id' => ['type'=>'int','constraint'=>10, 'usingned'=>true,'auto-increment'=>true ],
        'tgl'=> ['type'=>'date','null'=>true],
        'jadwal_praktek_id'=>['type'=>'int','constraint'=>10,'usingned'=>true,'auto-increment'=>true], 
        'pasien_id' =>['type'=>'int', 'constraint'=>3,'usingned'=>true,'auto-increment'=>true],
        'nomor_antrian' =>['type'=>'varchar','constraint'=>3, 'null'=>true],
        'berat_badan' =>['type'=>'double', 'null'=>true],
        'tinggi_badan' =>['type'=>'double','null'=>true],
        'lingkaran_kepala'=>['type'=>'double', 'null'=>true],
        'keluhan' =>['type'=>'varchar','constraint'=>512, 'null'=>true],
        'petugas_id'=>['type'=>'int', 'constraint'=>10,'usingned'=>true, 'auto_increment'=>true],
        'created_at'  =>['type'=>'datetime', 'null'=>true],
        'update_at'   =>['type'=>'datetime', 'null'=>true],
        'deleted'     =>['type'=>'datetime', 'null'=>true],
    ]);
$this->forge->addPrimaryKey('id');
}
    public function down()
    {
        $this->forge->dropTable('pendaftaran_konsultasi');
    }
}
