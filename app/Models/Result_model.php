<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Result_model extends Model
    {
        protected $table         = 'result_details';
        protected $primaryKey = 'id';
        protected $allowedFields = ['resultdesc','department_id','program_id','academic_start_year','academic_end_year','semester','notification_date','file_upload','upload_by'];
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