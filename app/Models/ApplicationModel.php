<?php 
namespace App\Models;
use CodeIgniter\Model;
class  ApplicationModel extends Model
{
    protected $table = 'awall_applications';
    protected $primaryKey = 'App_id';
    protected $allowedFields = ['Name', 'Username', 'adharno','panno','birthday', 'Gender', 'Occupation', 'Qualification', 'Father_name', 'Mother_name', 'Spouse_Name', 'Nominee_Name', 'Relation','Email', 'Country', 'state', 'Pincode', 'District','City', 'Paddress', 'Caddress', 'Mobile', 'Ophone', 'pfront', 'pback', 'afront', 'aback', 'selfie', 'referalcode', 'Application_Id','know','status'];

    public function  getshareholdersByAgentCode($agent_code) {
   

        // Get the database connection
        $db = $this->db;
    
        // Build the query using the query builder
        $query = $db->table('awall_applications')
                    ->where('referalcode', $agent_code)
                    ->get();
    
        // Check if rows were found
        if ($query->getNumRows() > 0) {
            return $query->getResult(); // Return multiple rows as an array of objects
        } else {
            return array(); // No tertiary managers found
        }
    }
}
?>