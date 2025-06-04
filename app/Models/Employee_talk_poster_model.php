<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Employee_talk_poster_model extends Model
    {
        protected $table         = 'employee_talk_poster';
        protected $primaryKey = 'id';
        protected $allowedFields = ['employee_id','event_name','location','organizing_institute_name','role','other_role','start_date','end_date','upload_by'];
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