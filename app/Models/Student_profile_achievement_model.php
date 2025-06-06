<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Student_profile_achievement_model extends Model
    {
        protected $table         = 'student_profile_achievement';
        protected $primaryKey    = 'id';
        protected $allowedFields = ['student_id','achievement_title','description', 'awarded_agency','award_level', 'award_date', 'file_upload'];
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
        public function getByStudent($id){
            return $this->where('student_id',$id)->findAll();
        }
    }
?>
