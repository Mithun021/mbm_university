<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Placement_details_model extends Model
    {
        protected $table         = 'placement_details';
        protected $primaryKey = 'id';
        protected $allowedFields = ['placement_batch','department_id','total_students','no_of_placed_students','not_interest_student','phd_students','upload_by'];
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
                $result = $this->orderBy('department_id','asc')->findAll();
            }
            return $result;
        }
    }
?>