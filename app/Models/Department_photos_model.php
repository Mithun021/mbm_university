<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Department_photos_model extends Model
    {
        protected $table         = 'department_photos';
        protected $primaryKey = 'id';
        protected $allowedFields = ['dept_id','upload_by'];
        protected $createdField  = 'created_at';

        public function add($data, $id = null) {
            if ($id != null) {
                $result = $this->update($id, $data);
                return $result ? true : 'Data not updated: Update failed.';
            } else {
                $result = $this->insert($data);
                if ($result) {
                    return $this->insertID(); // Return the inserted record's ID
                } else {
                    return 'Data not inserted: Insertion failed.';
                }
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