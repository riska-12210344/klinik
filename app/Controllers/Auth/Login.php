<?php

namespace App\Controllers\Auth;

use App\Models\UserModel;
use App\Controllers\BaseController;

class Login extends BaseController
{
    public function index()
    {
        //
        return view ('login');
    }

    public function action()
    {
        $session = session();
        $users = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $dataUser = $users->where([
            'email' => $email,
        ])->first();
        if ($dataUser) {
            if (password_verify($password, $dataUser->password)) {
                $session->set([
                    'email' => $dataUser->email,
                    'name' => $dataUser->name,
                    'logged_in' => TRUE
                ]);
                return redirect()->to(base_url('/home'));
            } else {
                $session->setFlashdata('error', 'Email & Password Salah');
                return redirect()->back();
            }
        } else {
            $session->setFlashdata('error', 'Email & Password Salah');
            return redirect()->back();
        }
    }

    public function off()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
