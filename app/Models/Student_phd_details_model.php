<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Student_phd_details_model extends Model
    {
        protected $table         = 'student_phd_details';
        protected $primaryKey = 'id';
        protected $allowedFields = ['student_id','phd_title','description','supervisor_name','current_status','registration_date','submission_date','award_date','file_upload'];
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
                $result = $this->orderBy('id','desc')->findAll();
            }
            return $result;
        }
        public function getByStudent($id){
            return $this->where('student_id',$id)->findAll();
        }
    }
?>
