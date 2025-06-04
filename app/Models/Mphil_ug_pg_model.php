<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Mphil_ug_pg_model extends Model
    {
        protected $table         = 'mphil_ug_pg_detail';
        protected $primaryKey = 'id';
        protected $allowedFields = ['employee_id','student_title','student_name','student_category','synopsis_name','roll_no','semester','remarks','university_name','registration_date','award_date','documemt_file','status','submission_date','upload_by'];
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