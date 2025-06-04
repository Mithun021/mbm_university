<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Job_detail_model extends Model
    {
        protected $table         = 'job_details';
        protected $primaryKey = 'id';
        protected $allowedFields = ['title','description','adv_reference_no','adv_apply_link','job_type_id','department_id','application_start_date','application_start_time','application_end_date','application_end_time','hardcopy_last_date','hardcopy_last_time','revised_app_last_date','revised_app_last_time','revised_copy_last_date','revised_copy_last_time','payment_link','adv_file','syllabus_file','status','upload_by'];
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