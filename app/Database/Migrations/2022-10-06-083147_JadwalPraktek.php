<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JadwalPraktek extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                  => [ 'type' =>'int', 'costraint'=>10,'unsigned'=>true,'auto_increment'=>true,'null'=>false],
            'poli_dokter_id'      => [ 'type' =>'int', 'costraint'=>10,'unsigned'=>true,'null'=>false],
            'hari'                => [ 'type' =>'int', 'costraint'=>11,'null'=>false],
            'jam_mulai'           => [ 'type' =>'time','null'=>false ],
            'jam_selesai'         => [ 'type' =>'time','null'=>true ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('JadwalPraktek');
        }

    public function down()
    {
        $this->forge->dropTable('JadwalPraktek');
    }
}
