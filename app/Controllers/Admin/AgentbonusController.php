<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BonusModel;

class AgentbonusController extends BaseController
{
    public function bonus_listall()
    {  

    $data['pageTitle']='bonuses';
    $bonuses = new BonusModel();
    $data['bonuses'] = $bonuses->orderBy('bonus_id','ASC')->findAll();
    return view('Admin/bonuses/bonus',$data);
    }

    
    public function bonus_add()
    {
       
    $data['pageTitle']='bonus';
    return view('Admin/bonuses/add_bonus',$data);
    }

    public function bonus_save()
    {
        $bonuses = new BonusModel();

        $data = [
            'bonus_in_percenatage' => $this->request->getVar('bonuspercentage'),
            'created_at'=>date('Y-m-d'),
        ];

        $bonuses->insert($data);

        return redirect()->to(site_url('Addwalls/agent_bonus')); // Use redirect() helper
    }

    public function edit_bonus($bonus_id)
    {
        $bonuses = new BonusModel();
        $data['bonuses'] = $bonuses->find($bonus_id); // Use 'dividend' instead of 'dividents'
        return view('Admin/bonuses/edit_bonus', $data);
    }

    public function update_bonus($bonus_id)
    {
        $bonuses = new BonusModel();
        // Retrieve dividend data from the form or request
        $data = [
            'bonus_in_percenatage' => $this->request->getVar('bonuspercentage'),
            'updated_at' => date('Y-m-d'), // Use MySQL date format
        ];


        // Call the model function to update dividend data
        $bonuses->update($bonus_id, $data);

        // Redirect to the dividend list page
        return redirect()->to(site_url('Addwalls/agent_bonus'));
    }

    public function delete_bonus($bonus_id)
    {
        $bonuses = new BonusModel();
        $deleted = $bonuses->delete($bonus_id);

        // Check if the dividend was successfully deleted
        if ($deleted) {
            return redirect()->to(site_url('Addwalls/agent_bonus'));
        }
    }
}
