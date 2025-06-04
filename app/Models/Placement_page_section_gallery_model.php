<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Placement_page_section_gallery_model extends Model
    {
        protected $table         = 'placement_page_section_gallery';
        protected $primaryKey = 'id';
        protected $allowedFields = ['placement_page_section_id','gallery_file'];
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
        public function getBysection($id){
            return $this->where('placement_page_section_id',$id)->findAll();
        }
    }
?>