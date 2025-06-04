<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Employee_mou_model extends Model
    {
        protected $table         = 'employee_mou';
        protected $primaryKey = 'id';
        protected $allowedFields = ['employee_id','mou_title','institution_name','entring_mou_year','duration','status','upload_by'];
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