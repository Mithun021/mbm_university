<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Employee_experience_model extends Model
    {
        protected $table         = 'employee_experience';
        protected $primaryKey = 'id';
        protected $allowedFields = ['emplyee_id','organization_name','start_date','end_date','stillwork','exp_description','org_type','work_nature','work_description','upload_by'];
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