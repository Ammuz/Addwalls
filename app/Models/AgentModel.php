<?php

namespace App\Models;

use CodeIgniter\Model;

class AgentModel extends Model
{
    protected $table = 'awall_agents';
    protected $primaryKey = 'a_id';
    protected $allowedFields = [ 'username','password','Agent_code', 'Name', 'FName', 'Address', 'Email', 'Mobile', 'accnumber', 'bname', 'ifsc', 'adharno', 'panno', 'pfront', 'afront', 'aback', 'Status', 'Created_at','tmanager_code'];

public function getAgentsByManagerTManagerCode($tmanager_manager_code) {
    // Get the database connection
    $db = $this->db;

    // Build the query using the query builder
    $query = $db->table('awall_agents')
                ->where('tmanager_code', $tmanager_manager_code)
                ->get();

    // Check if rows were found
    if ($query->getNumRows() > 0) {
        return $query->getResult(); // Return multiple rows as an array of objects
    } else {
        return array(); // No tertiary managers found
    }
}
public function getAgentById($agent_id) {
    // Get the database connection
    $db = $this->db;

    // Build the query using the query builder
    $query = $db->table('awall_agents')
                ->where('a_id', $agent_id)
                ->get();

    // Check if rows were found
    if ($query->getNumRows() == 1) {
        return $query->getRow(); // Return a single row (manager) as an object
    } else {
        return null; // Manager not found
    }
}
public function getAgentsWithLocations() {
    $this->db->select('agents.*, countries.country_name, states.state_name, districts.district_name');
    $this->db->from('agents');
    $this->db->join('countries', 'agents.country_id = countries.country_id');
    $this->db->join('states', 'agents.state_id = states.state_id');
    $this->db->join('districts', 'agents.district_id = districts.district_id');
    $query = $this->db->get();
    return $query->result();
}
}