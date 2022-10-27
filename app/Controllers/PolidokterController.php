<?php

namespace App\Controllers;
use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\PoliDokterModel;
use CodeIgniter\Exceptions\PageNotFoundException;

use function PHPUnit\Framework\returnself;

class PoliDokterController extends BaseController
{
    public function index(){
        return view('PoliDokter/table');
    }

    public function all(){
        $pm = new PoliDokterModel();
        $pm->select('id, poli_id, dokter_id');

        return (new Datatable( $pm ))
                ->setFieldFilter(['poli_id', 'dokter_id'])
                ->draw();
    }

    public function show($id){
        $r = (new PoliDokterModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }
    
    public function store(){
        $pm     = new PoliDokterModel();

        $id = $pm->insert([
            'poli_id'      => $this->request->getvar('poli_id'),
            'dokter_id'    => $this->request->getvar('dokter_id'),
            
        ]);
        return $this->response->setJSON(['id' => $id])
                    ->setStatusCode( intval($id) > 0 ? 200 : 406 );
    }

    public function update(){
        $pm     = new PoliDokterModel();
        $id     = (int)$this->request->getvar('id');

        if( $pm->find($id) == null )
            throw PageNotFoundException::forPageNotFound();

        $hasil  = $pm->update($id, [
            'poli_id'      => $this->request->getVar('poli_id'),
            'dokter_id'    => $this->request->getVar('dokter_id'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }

    public function delete(){
        $pm     = new PoliDokterModel();
        $id     = $this->request->getVar('id');
        $hasil  = $pm->delete($id);
        return $this->response->setJSON(['result' => $hasil ]);
    }

}
