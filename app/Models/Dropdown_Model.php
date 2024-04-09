<?php

namespace App\Models;

use CodeIgniter\Model;

class Dropdown_Model extends Model {
    
    protected $table = 'countries'; // Change this according to your database table name

    public function getStatesByCountry($country_id) {
        return $this->db->table('states')
            ->where('country_id', $country_id)
            ->get()
            ->getResult();
    }

    // Similarly, add methods to fetch districts and cities
}
