<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Student_achievement_model extends Model
    {
        protected $table         = 'student_achievements';
        protected $primaryKey    = 'id';
        protected $allowedFields = ['student_id','title','description', 'upload_file','award_level', 'student_name', 'department_id', 'course_id', 'supervisor_id', 'award_date', 'agency_name', 'upload_by'];
        protected $createdField  = 'created_at';

        public function add($data, $id = null) {
            if ($id != null) {
                $result = $this->update($id, $data);
                return $result ? true : 'Data not updated: Update failed.';
            } else {
                $result = $this->insert($data);
                return $result ? true : 'Data not inserted: Insertion failed.';
            }
        }

        public function get($id = null){
            if($id != null){
                $result = $this->where('id',$id)->first();
            }else{
                $result = $this->orderBy('id','asc')->findAll();
            }
            return $result;
        }
    }
?>
