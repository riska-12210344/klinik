<?php

namespace App\Controllers;
use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\DokterModel;
use CodeIgniter\Email\Email;
use CodeIgniter\Exceptions\PageNotFoundException;
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
        return view('Dokter/table');
    }
      
    public function all(){
        $pm = new DokterModel();
        $pm->select('id, nama, gender, email');

        return (new Datatable( $pm ))
                ->setFieldFilter(['nama', 'email', 'gender'])
                ->draw();
    }

    public function show($id){
        $r = (new DokterModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    
    public function store(){
        $pm     = new DokterModel();
        $sandi  = $this->request->getvar('sandi');

        $id = $pm->insert([
            'nama'      => $this->request->getvar('nama'),
            'gender'    => $this->request->getvar('gender'),
            'email'     => $this->request->getvar('email'),
            'sandi'     => password_hash($sandi, PASSWORD_BCRYPT),
        ]);
        return $this->response->setJSON(['id' => $this])
                    ->setStatusCode( intval($id) > 0 ? 200 : 406 );
    }

    public function update(){
        $pm     = new DokterModel();
        $id     = (int)$this->request->getvar('id');

        if( $pm->find($id) == null )
            throw PageNotFoundException::forPageNotFound();

        $hasil  = $pm->update($id, [
            'nama'      => $this->request->getVar('nama'),
            'gender'    => $this->request->getVar('gender'),
            'email'     => $this->request->getVar('email'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }

    public function delete(){
        $pm     = new DokterModel();
        $id     = $this->request->getVar('id');
        $hasil  = $pm->delete($id);
        return $this->response->setJSON(['result' => $hasil ]);
    }

}   
    
