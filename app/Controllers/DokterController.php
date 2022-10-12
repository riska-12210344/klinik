<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DokterModel;
use CodeIgniter\Email\Email;
use Config\Email as ConfigEmail;

class DokterController extends BaseController
{
    public function login()
    {
        $email      = $this->request->getPost('email');
        $password   = $this->request->getPost('sandi');

        $Dokter     = (new DokterModel())->where('email', $email)->first();

        if($Dokter == null){
            return $this->response->setJSON(['message'=>'Email tidak terdaftar'])
                                  ->setStatusCode(404);
        }

        $cekPassword = password_verify($password, $Dokter['sandi']);
        if($cekPassword == false){
            return $this->response->setJSON(['message'=>'Email dan sandi tidak cocok'])
                        ->setStatusCode(403);

        }
        $this->session->set('Dokter', $Dokter);
        return $this->response->setJSON(['message'=>"selamat datang {$Dokter['nama']} "])
                    ->setStatusCode(200);
    }

    public function viewLogin(){
        return view('login');
    }

    public function lupaPassword(){
        $_email = $this->request->getPost('email');

        $Dokter = (new DokterModel())->where('email', $_email)->first();

        if($Dokter == null){
            return $this->response->setJSON(['message'=>'Email tidak terdaftar'])
                                  ->setStatusCode(404);
        }

        $sandibaru = substr( md5( date('Y-m-dH:i:s')),5,5 );
        $Dokter['sandi'] = password_hash($sandibaru, PASSWORD_BCRYPT);
        $r = (new DokterModel())->update($Dokter['id'], $Dokter);

        if($r == false){
            return $this->response->setJSON(['message'=>'Gagal merubah sandi'])
                        ->setStatusCode(502);
        }

        $email = new Email(new ConfigEmail());
        $email->setFrom('gafriansyah12@gmail.com', 'Sistem Informasi Klinik');
        $email->setTo($Dokter['email']);
        $email->setSubject('Reset Sandi Pengguna');
        $email->setMessage("Hallo {$Dokter['nama']} telah meminta reset baru. Reset baru kamu adalah <b>$sandibaru</b>");
        $r = $email->send();

        if($r == true){
            return $this->response->setJSON(['message'=>"Sandi baru sudah di kirim ke alamat email $_email"])
                        ->setStatusCode(200);
        }else{
            return $this->response->setJSON(['message'=>"Maaf ada kesalahan pengiriman email ke $_email"])
                                ->setStatusCode(500);
        }
    }

    public function viewLupaPassword(){
        return view('lupa_password');
    }

    public function logout(){
        $this->session->destroy();
        return redirect()->to('login');
    }

    public function index(){
        
    }
}

