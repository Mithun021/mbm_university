<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Phd_detail_model extends Model
    {
        protected $table         = 'php_details';
        protected $primaryKey = 'id';
        protected $allowedFields = ['employee_id','degree_type','subject_studied','phd_thesis','degree_status','registration_date','submission_date','award_date','university','university_country','university_state','upload_by'];
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