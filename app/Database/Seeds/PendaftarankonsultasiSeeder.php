<?php

namespace App\Database\Seeds;

use App\Models\Pendaftarankonsultasi;
use App\Models\PendaftarankonsultasiModel;
use CodeIgniter\Database\Seeder;
use PhpParser\Node\Stmt\Echo_;

class PendaftarankonsultasiSeeder extends Seeder
{
    public function run()
    {
        (new PendaftarankonsultasiModel())->insert([
            ['pendafftran'=>'nama'],
            ['pendaftaran'=>'jenis kelamin'],
            ['pendaftaran'=>'umur'],
            ['pendaftaran'=>'no'],          
        ]);
    }
}
