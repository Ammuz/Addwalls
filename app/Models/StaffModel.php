<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffModel extends Model
{
    protected $table = 'awall_staff';
    protected $primaryKey = 'staff_id';
    protected $allowedFields = [ 'staff_id', 'Staff_type', 'StaffKey', 'Description', 'Status'];
}
