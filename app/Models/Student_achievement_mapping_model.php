<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Student_achievement_mapping_model extends Model
    {
        protected $table         = 'student_achievements_mapping';
        protected $primaryKey    = 'id';
        protected $allowedFields = ['student_achievement_mapping_id','student_name','department_id','course_id','supervisor_id'];
        // protected $createdField  = 'created_at';

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

        public function get_by_student_achiv_id($id){
            return $this->where('student_achievement_mapping_id',$id)->findAll();
        }
    }
?>
