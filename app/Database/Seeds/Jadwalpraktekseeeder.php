<?php

namespace App\Database\Seeds;

use App\Database\Migrations\JadwalPraktek;
use App\Models\JadwalModel;
use CodeIgniter\Database\Seeder;
class Jadwalpraktekseeeder extends Seeder
{
    public function run()
    {
    (new JadwalModel())->insertBatch([
       ['Jadwal'=>'waktu Masuk'],
       ['Jadwal'=>'waktu Keluar'],
       ['jadwal'=>'waktu istirahat'], 
    ]);
    }
}
