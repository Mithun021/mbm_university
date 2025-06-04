<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Adjunt_other_faculty_designation_map_model extends Model
    {
        protected $table         = 'adjunt_other_faculty_designation_map';
        protected $primaryKey    = 'id';
        protected $allowedFields = ['adjunt_faculty_id','designation','organisation_name','organisation_address'];
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
        public function getByAdjunt_id($id){
            $result = $this->orderBy('id','asc')->findAll();
            return $result;
        }
    }
?>
