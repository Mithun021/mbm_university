<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Job_extension_model extends Model
    {
        protected $table         = 'job_extension';
        protected $primaryKey = 'id';
        protected $allowedFields = ['job_id','ext_notice_title','revised_app_last_date','revised_app_last_time','revised_copy_last_date','revised_copy_last_time','ext_notice_file','upload_by'];
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