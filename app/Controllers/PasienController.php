<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Database\Migrations\Pasien;
use App\Models\PasieniModel;
use CodeIgniter\Debug\Toolbar\Collectors\Views;
use CodeIgniter\Email\Email;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\Email as ConfigEmail;

class PasienController extends BaseController
{
    public function login()
    { 
        $email      = $this->request->getPost('email');
        $passsword  = $this->request->getpost('sandi');

        $Pasien     = (new PasieniModel())->where('email', $email)->first();

        if($Pasien == null){
            return $this->response->setJSON(['message'=>'Email tidak terdaftar'])
                                  ->setStatusCode(404);
        }

        $cekPassword = password_verify($passsword, $Pasien['sandi']);
        if($cekPassword == false){
            return $this->response->setJSON(['message'=>'Email dan sandi tidak cocok'])
                                   ->setStatusCode(403);
        }
        
        $this->session->set('pasien', $Pasien);
            return $this->response->setJSON(['message'=>"selamat datang {$Pasien['nama']} "])
                                    ->setStatusCode(200);
    }

    public function viewLogin(){
            return view('login');
    }

    public function lupaPasswoard(){

          $_email = $this->request->getPost('email');

          $Pasien = (new PasieniModel())->where('email', $_email)->first();

            if($Pasien == null){
             return $this->response->setJSON(['message'=>'Email tidak terdaftar'])
                ->setStatusCode(404);
            }

          $sandibaru = substr(md5( date('Y-m-dH: i:s')),5,5);
          $Pasien['sandi'] = password_hash($sandibaru, PASSWORD_BCRYPT);
           $r = (new PasieniModel())->update($Pasien['id'], $Pasien);

           if($r == false){
             return $this->response->setJSON(['message'=>'Gagal merubah sandi'])
                ->setStatusCode(502);
            }

       $email = new Email(new ConfigEmail());
       $email->setFrom('imanuelhero76@gmail.com', 'Sistem informasi klinik');
       $email->setTO($Pasien['email']);
       $email->setSubject('Reset sandi pengguna');
       $email->setMessage("Hallo {$Pasien['nama']} telah meminta reset baru. reset baru kamu adalah <b>$sandibaru</b>");
       $r = $email->send();


           if($r == true){
        return $this->response->setJSON(['message'=>"sandi baru sudah di kirim ke alamat email $_email"])
                ->setStatusCode(200);                
        }

          return $this->response->setJSON(['message'=>"Maaf ada kesalahan pengiriman email ke $_email"])
                ->setStatusCode(500);
    }
    
    public function viewLupaPassword (){
        return view('upa_password');
    }

    public function logout(){
        $this->session->session->destroy();
        return redirect()->to('login');
    }

    public function index(){
        return view('pengguna/table');
    }

    public function all(){
        $pm = new PasieniModel();
        $pm->select('id, nama, jenis_kelamin, email');

        return (new Datatable($pm ))
                ->setFieldFilter(['nama', 'email', 'jenis_kelamin'])
                ->draw();
    }

    public function show($id){
        $r = (new PasieniModel())->where('id, $id')->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }

    public function store(){
       $pm    = new PasieniModel();
       $sandi = $this->request->getVar('sandi');

       $id = $pm->inser([
           'id'            => $this->request->getVar('id'),
           'no_rekammedik' => $this->request->getVar('no_rekammedik'),
           'nama_depan'    => $this->request->getVar('nama_depan'),
           'nama_belakang' => $this->request->getVar('nama_belakang'),
           'nik'           => $this->request->getVar('nik'),
           'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
           'tgl_lahir'     => $this->request->getVar('tgl_lahir'),
           'tempat_lahir'  => $this->request->getVar('tempat_lahir'),
           'alamat'        => $this->request->getVar('alamat'),
           'kota'          => $this->request->getVar('kota'),
           'no_telp'       => $this->request->getVar('no_telp'),
           'email'         => $this->request->getVar('email'),
           'golongan_darah'=> $this->request->getVar('golongan_darah'),
           'foto'          => $this->request->getVar('foto'),
           'sandi'         => password_hash($sandi, PASSWORD_BCRYPT), 
       ]);
        return $this->response->setJSON(['id' => $id])
                    ->setStatusCode( intval($id) > 0 ? 200 : 406 );
    }
     
    public function update(){
        $pm    = new PasieniModel();
        $id    = (int)$this->request->getVar('id');

       if( $pm->find($id)  == null )
       throw PageNotFoundException::forPageNotFound();


        $hasil = $pm->update($id, [
        'nama'          => $this->request->getVar('nama'),
        'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
        'email'         => $this->request->getVar('email'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);     
    }

    public function delete(){
       $pm    = new PasieniModel();
       $id    = $this->request->getVar('id');
       $hasil = $pm->delete($id);
       return $this->response->setJSON(['result' => $hasil ]); 
    }
}    
