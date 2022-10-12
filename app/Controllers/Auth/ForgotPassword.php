<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class ForgotPassword extends BaseController
{
    public function index()
    {
        //
        return view ('forgotpassword');
    }
}
