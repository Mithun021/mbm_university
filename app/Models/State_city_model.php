<?php

namespace App\Models;

use CodeIgniter\Model;

class State_city_model extends Model
{
    protected $table         = 'state_city';
    protected $primaryKey = 'id';
    protected $allowedFields = ['state', 'city'];
    // protected $createdField  = 'created_at';

    public function add($data, $id = null)
    {
        if ($id != null) {
            $result = $this->update($id, $data);
            return $result ? true : 'Data not updated: Update failed.';
        } else {
            $result = $this->insert($data);
            return $result ? true : 'Data not inserted: Insertion failed.';
        }
    }

    public function get($id = null)
    {
        if ($id != null) {
            $result = $this->where('id', $id)->first();
        } else {
            $result = $this->findAll();
        }
        return $result;
    }

    public function get_state()
    {
        return $this->distinct()->select('state')->findAll();
    }
    public function find_city($state)
    {
        return $this->where('state', $state)
            ->select('city')
            ->distinct()
            ->findAll();
    }
}
