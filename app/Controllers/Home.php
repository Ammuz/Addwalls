<?php

namespace App\Controllers;
use App\Models\ParamModel;
class Home extends BaseController
{
    public function index()
    {
        $aps = new ParamModel();
        $data['pageTitle']='Share Holder';
        $data['app'] = $aps->findAll();
        return view('welcome_message',$data);
    }
}
