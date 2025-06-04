<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Employee_publication_author_model extends Model
    {
        protected $table         = 'employee_publication_author';
        protected $primaryKey = 'id';
        protected $allowedFields = ['author_name','emp_publication_id'];

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

        public function getByPublication($id){
            return $this->where('emp_publication_id',$id)->findAll();
        }

        
        
    }
?>