<?php
namespace App\Models;

use CodeIgniter\Model;

class DistrictModel extends Model {
    protected $table = 'districts';
    protected $primaryKey = 'dist_id';
    protected $allowedFields = [ 'state_id','dist_id','dist_name'];
}
