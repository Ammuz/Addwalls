<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DividendModel;

class DividendController extends BaseController
{
    public function dividend_listall()
    {  

    $data['pageTitle']='dividends';
    $dividends = new DividendModel();
    $data['dividends'] = $dividends->orderBy('dividend_id','ASC')->findAll();
    return view('Admin/dividends/dividend',$data);
    }

    
    public function dividend_add()
    {
       
    $data['pageTitle']='dividend';
    return view('Admin/dividends/add_dividend',$data);
    }

    public function dividend_save()
    {
        $dividends = new DividendModel();

        $data = [
            'dividend' => $this->request->getVar('dividend'),
            'created_at' => date('Y-m-d'),
        ];
        //print_r($data);exit;

        $dividends->insert($data);

        return redirect()->to(site_url('/Addwalls/dividend')); // Use redirect() helper
    }

    public function edit_dividend($dividend_id)
    {
        $dividends = new DividendModel();
        $data['dividends'] = $dividends->find($dividend_id); // Use 'dividend' instead of 'dividents'
        return view('Admin/dividends/edit_dividend', $data);
    }

    public function update_dividend($dividend_id)
    {
        $dividends = new DividendModel();
        // Retrieve dividend data from the form or request
        $data = [
            'dividend' => $this->request->getVar('dividend'),
            'updated_at' => date('Y-m-d'),
           
        ];

        // Call the model function to update dividend data
        $dividends->update($dividend_id, $data);

        // Redirect to the dividend list page
        return redirect()->to(site_url('/Addwalls/dividend'));
    }

    public function delete_dividend($dividend_id)
    {
        $dividends = new DividendModel();
        $deleted = $dividends->delete($dividend_id);

        // Check if the dividend was successfully deleted
        if ($deleted) {
            return redirect()->to(site_url('/Addwalls/dividend'));
        }
    }
}
