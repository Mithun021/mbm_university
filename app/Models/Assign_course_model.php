<?php

namespace App\Models;

use CodeIgniter\Model;

class Assign_course_model extends Model
{
    protected $table         = 'assign_course';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['dept_id', 'program_id', 'semester', 'course_id', 'credits', 'upload_by'];
    protected $createdField  = 'created_at';

    public function add($data, $id = null)
    {
        if ($id != null) {
            $result = $this->update($id, $data);
            return $result ? true : 'Data not updated: Update failed.';
        } else {
            $conditions = [
                'dept_id' => $data['dept_id'],
                'program_id' => $data['program_id'],
                'semester' => $data['semester'],
                'course_id' => $data['course_id'],
                'credits' => $data['credits'],
            ];
            $check = $this->where($conditions)->first();
            if (!$check) {
                $result = $this->insert($data);
                return $result ? true : 'Data not inserted: Insertion failed.';
            }else{
                return $check ? true : 'Data not inserted: Insertion failed.';
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

    // public function getActiveData(){
    //     return $this->orderBy('id','asc')->findAll();
    // }

    public function getCourseByDepartment($department_id)
    {
        $this->select('courses.id as course_id, courses.course_name, courses.course_code');
        $this->join('courses', 'courses.id = assign_course.course_id');
        $this->where('assign_course.dept_id', $department_id);
        return $this->findAll(); 
    }
}
