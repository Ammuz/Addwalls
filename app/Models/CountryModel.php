<?php
namespace App\Models;

use CodeIgniter\Model;

class CountryModel extends Model {
    protected $table = 'countries';
    protected $primaryKey = 'country_id';
    protected $allowedFields = [ 'country_id','country_name'];

    public function getCountryName($value)
{
    $country = $this->find($value);
    return ($country) ? $country['country_name'] : null;
}
}