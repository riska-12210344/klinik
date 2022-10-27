<?php

    namespace App\Controllers;
    
    use Agoenxz21\Datatables\Datatable;
    use App\Controllers\BaseController;
use App\Database\Migrations\JadwalPraktek;
use App\Database\Migrations\Pasien;
use App\Models\JadwalModel;
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
            $pm = new JadwalModel();
            $pm->select('id, poli_dokter_id, hari, jam_mulai, jam_selesai');
    
            return (new Datatable($pm ))
                    ->setFieldFilter(['id, poli_dokter_id, hari, jam_mulai, jam_selesai'])
                    ->draw();
    }
    
    public function show($id){
            $r = (new JadwalModel())->where('id, $id')->first();
            if($r == null)throw PageNotFoundException::forPageNotFound();
    
            return $this->response->setJSON($r);
    }
    
    public function store(){
           $pm    = new JadwalModel();
           $sandi = $this->request->getVar('sandi');
    
           $id = $pm->inser([
               'nama'   => $this->request->getVar('nama'),
               'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
               'email'  => $this->request->getVar('email'),
               'sandi'  => password_hash($sandi, PASSWORD_BCRYPT), 
           ]);
            return $this->response->setJSON(['id' => $id])
                        ->setStatusCode( intval($id) > 0 ? 200 : 406 );
    }
         
    public function update(){
           $pm    = new JadwalModel();
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
        $pm    = new JadwalModel();
        $id    = $this->request->getVar('id');
        $hasil = $pm->delete($id);
        return $this->response->setJSON(['result' => $hasil ]); 
     }     
    
} 
