<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PetugasId extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type'=>'int','constraint'=>10, 'usingned'=>true,'auto-increment'=>true ],
            'email' =>['type'=>'varchar','constraint'=>100, 'null'=>false],
            'nama_lengkap' =>['type'=>'varchar','constraint'=>100, 'null'=>false],
            'level' =>['type'=>'enum("REG","KASIR","MANAGER")', 'null'=>true],
            'sandi' =>['type'=>'varchar','constraint'=>60, 'null'=>true],
            'foto' => ['type'=>'varchar', 'constraint'=>126,'null'=>true],
            'reset_tokan' =>['type'=>'varchar','constraint'=>10,'null'=>true],
            'created_at'  =>['type'=>'datetime', 'null'=>true],
            'update_at'   =>['type'=>'datetime', 'null'=>true],
            'deleted'     =>['type'=>'datetime', 'null'=>true],
        ]);
    $this->forge->addprimarykey('id');
    $this->forge->createTable('petugas');
    }
    public function down()
    {
        $this->forge->droptable('petugas');
    }
}
