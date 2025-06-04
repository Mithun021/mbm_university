<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Student_patent_author_model extends Model
    {
        protected $table         = 'student_patent_author';
        protected $primaryKey = 'id';
        protected $allowedFields = ['student_patent_id','author_name'];
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
                $result = $this->orderBy('id','desc')->findAll();
            }
            return $result;
        }
        public function getByPatent($id){
            return $this->where('student_patent_id',$id)->findAll();
        }
    }
?>
