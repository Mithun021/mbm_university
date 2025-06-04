<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Collaboration_model extends Model
    {
        protected $table         = 'collaboration';
        protected $primaryKey = 'id';
        protected $allowedFields = ['title','description','institute_name','collaboration_date','collaboration_end_date','institute_logo','institute_link','collaboration_file','classified_mou','faculty_coordinator','collaboration_tenure_year','status','upload_by'];
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