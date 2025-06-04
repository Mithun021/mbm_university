<?php

namespace App\Models;

use CodeIgniter\Model;

class Country_model extends Model
{
    protected $table         = 'country';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['country', 'state'];

    public function add($data, $id = null)
    {
        if ($id != null) {
            $result = $this->update($id, $data);
            return $result ? true : 'Data not updated: Update failed.';
        } else {
            $existingStudent = $this->where('country', $data['country'])->where('state', ucwords($data['state']))->first();
            if ($existingStudent) {
                return 'Data not inserted: Course already exists.';
            }else{
                $result = $this->insert($data);
                return $result ? true : 'Data not inserted: Insertion failed.';
            }
        }
    }

    public function get($id = null)
    {
        if ($id != null) {
            $result = $this->where('id', $id)->first();
        } else {
            $result = $this->orderBy('id', 'asc')->findAll();
        }
        return $result;
    }
    
    public function getCountry() {
        $result = $this->distinct()->select('country')->findAll();
        return $result;
    }
    

    public function getState($country){
        return $this->where('country', $country)->findAll();
    }
}
