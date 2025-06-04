<?php

namespace App\Models;

use CodeIgniter\Model;

class Courses_model extends Model
{
    protected $table         = 'courses';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['course_name', 'course_code', 'status', 'upload_by'];
    protected $createdField  = 'created_at';

    public function add($data, $id = null)
    {
        if ($id != null) {
            $result = $this->update($id, $data);
            return $result ? true : 'Data not updated: Update failed.';
        } else {
            $existingStudent = $this->where('course_code', $data['course_code'])->where('course_name', ucwords($data['course_name']))->first();
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

    public function getActiveData()
    {
        return $this->orderBy('id', 'asc')->findAll();
    }
}
