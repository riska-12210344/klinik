<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Database\Migrations\Pasien;
use App\Models\PasieniModel;
use App\Models\PendaftarankonsultasiModel;
use CodeIgniter\Debug\Toolbar\Collectors\Views;
use CodeIgniter\Email\Email;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\Email as ConfigEmail;

class PasienController extends BaseController
 {
    public function index(){
        return view('petugas/table');
}

public function all(){
        $pm = new PendaftarankonsultasiModel();
        $pm->select('id, nama, jenis_kelamin, email');

        return (new Datatable($pm ))
                ->setFieldFilter(['nama', 'email', 'jenis_kelamin'])
                ->draw();
}

public function show($id){
        $r = (new PendaftarankonsultasiModel())->where('id, $id')->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
}

public function store(){
       $pm    = new PendaftarankonsultasiModel();
       $sandi = $this->request->getVar('sandi');

       $id = $pm->inser([
        'id'                 => $this->request->getVar('id'),
        'tgl'                => $this->request->getVar('tgl'),
        'jadwal_praktek_id'  => $this->request->getVar('jadwal_praktek_id'),
        'pasien_id'          => $this->request->getVar('pasien_id'),
        'no_antrian'         => $this->request->getVar('no_antrian'),
        'berat_badan'        => $this->request->getVar('berat_badan'),
        'tinggi_badan'       => $this->request->getVar('tinggi_badan'),
        'temp_badan'         => $this->request->getVar('temp_badan'),
        'lingkar_kepala'     => $this->request->getVar('lingkar_kepala'),
        'keluhan'            => $this->request->getVar('keluhan'),
        'sandi'              => password_hash($sandi, PASSWORD_BCRYPT), 
       ]);
        return $this->response->setJSON(['id' => $id])
                    ->setStatusCode( intval($id) > 0 ? 200 : 406 );
}
     
public function update(){
       $pm    = new PendaftarankonsultasiModel();
       $id    = (int)$this->request->getVar('id');

       if( $pm->find($id)  == null )
       throw PageNotFoundException::forPageNotFound();

       $hasil = $pm->update($id, [
        'nama'   => $this->request->getVar('nama'),
        'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
        'email'  => $this->request->getVar('email'),
     ]);
        return $this->response->setJSON(['result'=>$hasil]);     
}

public function delete(){
    $pm    = new PendaftarankonsultasiModel();
    $id    = $this->request->getVar('id');
    $hasil = $pm->delete($id);
    return $this->response->setJSON(['result' => $hasil ]); 
 }     

}