<?php

namespace App\Controllers\Superadmin;
use App\Controllers\BaseController;
class SadminController extends BaseController
{

    public function index()
    {
       
    
        return view('Admin/dashboard');
    }
}