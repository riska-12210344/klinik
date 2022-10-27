<?php

namespace App\Controllers;
use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\SpesialisDokterModel;
use CodeIgniter\Exceptions\PageNotFoundException;

use function PHPUnit\Framework\returnself;

class SpesialisDokterController extends BaseController
{
    public function index(){
        return view('Dokter/table');
    }
    public function all(){
        $pm = new SpesialisDokterModel();
        $pm->select('id, dokter_id, spesialis_id');
    
        return (new Datatable( $pm ))
        ->setFieldFilter(['dokter-id', 'spesialis_id'])
        ->draw();
    }

    public function show($id){
        $r = (new SpesialisDokterModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }

    public function store(){
        $pm     = new SpesialisDokterModel();

        $id = $pm->insert([
            'dokter_id'      => $this->request->getvar('dokter_id'),
            'spesialis_id'    => $this->request->getvar('spesialis_id'),
        ]);
        return $this->response->setJSON(['id' => $id])
                    ->setStatusCode( intval($id) > 0 ? 200 : 406 );
    }

    public function update(){
        $pm     = new SpesialisDokterModel();
        $id     = (int)$this->request->getvar('id');

        if( $pm->find($id) == null )
            throw PageNotFoundException::forPageNotFound();

        $hasil  = $pm->update($id, [
            'dokter_id'      => $this->request->getVar('dokter_id'),
            'spesialis_id'    => $this->request->getVar('spesialis_id'),
        ]);
        return $this->response->setJSON(['result'=>$hasil]);
    }

    public function delete(){
        $pm     = new SpesialisDokterModel();
        $id     = $this->request->getVar('id');
        $hasil  = $pm->delete($id);
        return $this->response->setJSON(['result' => $hasil ]);
    }

}
