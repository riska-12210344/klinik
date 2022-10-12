<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        //
        $session = session();
        $data['nama'] = "Welcome back, ".$session->get('name');
        return view('dashboard/home',$data);
    }
}
