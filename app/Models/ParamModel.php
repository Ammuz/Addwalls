<?php

namespace App\Models;

use CodeIgniter\Model;

class ParamModel extends Model
{
    protected $table = 'param';
    protected $primaryKey = 'param_id';
    protected $allowedFields = ['shap_id','agent_code','manager_code','tmanager_code'];
}