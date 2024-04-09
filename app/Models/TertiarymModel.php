<?php 
namespace App\Models;
use CodeIgniter\Model;
class  TertiarymModel extends Model
{
    protected $table = 'tertiary_manager';
    protected $primaryKey = 'Tmanager_id';
    protected $allowedFields = ['tmanager_code','email', 'username', 'password','Adhar_cardno','Adhar_card_front', 'Adhar_card_back', 'Caddress', 'Paddress','Dob','Nominee','Relationship_with_nominee','Father', 'Mother','Education','Pancardno','Pancard_front', 'country_id', 'state_id','district_id','city_id', 'Paddress', 'Caddress','Status','Pin','manager_code'];


    
    public function getCountryNameById($country_id)
    {
        $query = $this->db->table('countries')->select('country_name')->where('country_id', $country_id)->get();
        $result = $query->getRow();
        return $result ? $result->country_name : '';
    }
    public function getStateNameById($state_id)
    {
        $query = $this->db->table('states')->select('state_name')->where('state_id', $state_id)->get();
        $result = $query->getRow();
        return $result ? $result->state_name : '';
    }

    public function getDistrictNameById($district_id)
    {
        $query = $this->db->table('districts')->select('dist_name')->where('dist_id', $district_id)->get();
        $result = $query->getRow();
        return $result ? $result->dist_name : '';
    }

    public function getCityNameById($city_id)
    {
        $query = $this->db->table('cities')->select('city_name')->where('city_id', $city_id)->get();
        $result = $query->getRow();
        return $result ? $result->city_name : '';
    }




    public function getCountryIdByName($countryName)
    {
        $query = $this->db->table('countries')->select('country_id')->where('country_name', $countryName)->get();
        $result = $query->getRow();
        return $result ? $result->country_id : null;
    }
  public function getStateIdByName($stateName)
    {
        $query = $this->db->table('states')->select('state_id')->where('state_name', $stateName)->get();
        $result = $query->getRow();
        return $result ? $result->state_id : null;
    }
    public function getDistrictIdByName($districtName)
    {
        $query = $this->db->table('districts')->select('dist_id')->where('dist_name', $districtName)->get();
        $result = $query->getRow();
        return $result ? $result->dist_id : null;
    }
    public function getCityIdByName($citytName)
    {
        $query = $this->db->table('cities')->select('city_id')->where('city_name', $citytName)->get();
        $result = $query->getRow();
        return $result ? $result->city_id : null;
    }
    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
    public function getTertiaryManagersByManagerManagerCode($manager_manager_code) {
        // Get the database connection
        $db = $this->db;

        // Build the query using the query builder
        $query = $db->table('tertiary_manager')
                    ->where('manager_code', $manager_manager_code)
                    ->get();

        // Check if rows were found
        if ($query->getNumRows() > 0) {
            return $query->getResult(); // Return multiple rows as an array of objects
        } else {
            return array(); // No tertiary managers found
        }
    }
    public function getTManagerById($tmanager_id) {
        // Get the database connection
        $db = $this->db;

        // Build the query using the query builder
        $query = $db->table('tertiary_manager')
                    ->where('Tmanager_id', $tmanager_id)
                    ->get();

        // Check if rows were found
        if ($query->getNumRows() == 1) {
            return $query->getRow(); // Return a single row (manager) as an object
        } else {
            return null; // Manager not found
        }
    }

}