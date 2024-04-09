<?php
namespace App\Models;

use CodeIgniter\Model;

class Usermodel extends Model
{
    protected $table = 'user_table';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['username','password','user_type','users_id'];

    
}