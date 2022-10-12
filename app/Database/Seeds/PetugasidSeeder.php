<?php

namespace App\Database\Seeds;

use App\Models\PetugasModel;
use CodeIgniter\Database\Seeder;

class PetugasidSeeder extends Seeder
{
    public function run()
    {
     
       (int) (new PetugasModel())->insert([
            'nama' => 'Administrator',
            'gender' => 'L',
            'email' => 'manuelputra79@gmail.ocm',
            'sandi' => password_hash('000888',PASSWORD_BCRYPT),
            'petugas'=>'umur',
            'petugas'=>'jam masuk',
            'petugas'=>'jam keluar',
       ]);
    }
}
