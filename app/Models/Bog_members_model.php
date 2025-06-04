<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Bog_members_model extends Model
    {
        protected $table         = 'bog_members';
        protected $primaryKey    = 'id';
        protected $allowedFields = ['member_name','affiliation', 'designation', 'term_start_year', 'term_end_year', 'sorted_no', 'upload_by'];
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
                $result = $this->orderBy('sorted_no','asc')->findAll();
            }
            return $result;
        }
    }
?>
