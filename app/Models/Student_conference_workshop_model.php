<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Student_conference_workshop_model extends Model
    {
        protected $table         = 'student_conference_workshop';
        protected $primaryKey    = 'id';
        protected $allowedFields = ['student_id','conference_title','description', 'conference_date','conference_duration', 'paper_datils', 'file_upload'];
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
