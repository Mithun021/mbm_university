<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Placement_job_result_model extends Model
    {
        protected $table         = 'placement_job_result';
        protected $primaryKey = 'id';
        protected $allowedFields = ['job_id','result_title','result_description','result_file','notification_date','upload_by'];
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
        public function getByJobid($id){
            return $this->where('job_id',$id)->findAll();
        }
    }
?>