<?php
namespace App\Models;

use CodeIgniter\Model;

class CityModel extends Model {
    protected $table = 'cities';
    protected $primaryKey = 'city_id';
    protected $allowedFields = [ 'city_id','dist_id','city_name'];
}
