<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Ongoing_phd_model extends Model
    {
        protected $table         = 'ongoing_phd';
        protected $primaryKey = 'id';
        protected $allowedFields = ['employee_id','student_name','subject_thesis','university_name','department','university_country','role','registration_date','document_file','submission_date','award_date','status','upload_by'];
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