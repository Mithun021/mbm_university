<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Student_academic_details_model extends Model
    {
        protected $table         = 'student_academic_Details';
        protected $primaryKey = 'id';
        protected $allowedFields = ['student_id','degree_type','other_degree_name','board_institute_name','subject_studied','marks_type','marks_obtained','result_declaration_date','degree_date','upload_file'];
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
