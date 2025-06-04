<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Faculty_awards_mapping_model extends Model
    {
        protected $table         = 'faculty_awards_mapping';
        protected $primaryKey    = 'id';
        protected $allowedFields = ['faculty_award_id','faculty_name','department_id','designation_id'];
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
                $result = $this->orderBy('id','asc')->findAll();
            }
            return $result;
        }

        public function get_by_faculty_award_id($id){
            return $this->where('faculty_award_id',$id)->findAll();
        }
    }
?>
