<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Employee_academic_details_model extends Model
    {
        protected $table         = 'employee_academic_Details';
        protected $primaryKey = 'id';
        protected $allowedFields = ['employee_id','degree_type','degree_name','subject_studied','marking_scheme','obtained_result','passing_year','university','university_country','university_state','document_file','upload_by'];
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