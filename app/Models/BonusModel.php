<?php
namespace App\Models;

use CodeIgniter\Model;

class Bonusmodel extends Model
{
    protected $table = 'awall_bonus';
    protected $primaryKey = 'bonus_id';
    protected $allowedFields = ['bonus_in_percenatage','created_at','updated_at'];

    
}
