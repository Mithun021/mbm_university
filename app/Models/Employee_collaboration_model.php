<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Employee_collaboration_model extends Model
    {
        protected $table         = 'employee_collaboration';
        protected $primaryKey = 'id';
        protected $allowedFields = ['employee_id','title','collaborative_agency','collaboration_year','duartion_in_month','name_of_activity','file_upload','upload_by'];
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