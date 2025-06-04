<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Student_hobbies_model extends Model
    {
        protected $table         = 'student_hobbies';
        protected $primaryKey    = 'id';
        protected $allowedFields = ['student_id','hobbies'];
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
        public function getByStudent($id){
            return $this->where('student_id',$id)->findAll();
        }
    }
?>
