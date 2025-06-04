<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Employee_projects_model extends Model
    {
        protected $table         = 'employee_projects';
        protected $primaryKey = 'id';
        protected $allowedFields = ['emplyee_id','project_title','project_description','start_date','start_time','end_date','end_time','sanctioned_year','project_status','sponsored_by','project_value','role','funding_source','other_funding_source','upload_by'];
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
                $result = $this->orderBy('emplyee_id','asc')->findAll();
            }
            return $result;
        }

        
        
    }
?>