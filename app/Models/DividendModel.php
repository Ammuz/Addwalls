<?php
namespace App\Models;

use CodeIgniter\Model;

class Dividendmodel extends Model
{
    protected $table = 'dividends';
    protected $primaryKey = 'dividend_id';
    protected $allowedFields = ['dividend','created_at','updated_at']; // List allowed fields for insertion
  // protected $useTimestamps = true;
}