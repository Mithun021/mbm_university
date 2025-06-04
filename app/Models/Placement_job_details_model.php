<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Placement_job_details_model extends Model
    {
        protected $table         = 'placement_job_details';
        protected $primaryKey = 'id';
        protected $allowedFields = ['company_name','job_title','job_description','no_of_position','minimum_salary','maximun_salary','hiring_date_time','venue','meeting_link','upload_by'];
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
        public function getByCompany($id){
            return $this->orderBy('id','asc')->findAll();
        }
    }
?>