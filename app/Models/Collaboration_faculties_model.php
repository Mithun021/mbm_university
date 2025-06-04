<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Collaboration_faculties_model extends Model
    {
        protected $table         = 'collaboration_faculties';
        protected $primaryKey = 'id';
        protected $allowedFields = ['collaboration_id','faculty_name'];
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
                $result = $this->orderBy('id','desc')->findAll();
            }
            return $result;
        }
        public function getByColId($id){
            return $this->where('collaboration_id',$id)->findAll();
        }
    }
?>
