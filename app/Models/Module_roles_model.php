<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Module_roles_model extends Model
    {
        protected $table         = 'module_roles';
        protected $primaryKey = 'id';
        protected $allowedFields = ['module_id','employee_id','status'];
        // protected $createdField  = 'created_at';

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
                $result = $this->orderBy('publish_date','asc')->findAll();
            }
            return $result;
        }
    }
?>