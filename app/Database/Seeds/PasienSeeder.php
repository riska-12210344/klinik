<?php

namespace App\Database\Seeds;

use App\Models\PasieniModel;
use CodeIgniter\Database\Seeder;

class PasienSeeder extends Seeder
{
    public function run()
    {
         (new PasieniModel())->insertBatch([   
           ['pasien'=>'nama'],
           ['pasien'=>'jenis kelamin'],
           ['pasien'=>'umur'],
           ['pasien'=>'ruangan'],
                 ]);
                }
            }      