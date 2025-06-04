<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Quick_link_model extends Model
    {
        protected $table         = 'quick_links';
        protected $primaryKey = 'id';
        protected $allowedFields = ['title','page_url','image_file','description','status','upload_by'];
        protected $createdField  = 'created_at';

        public function add($data, $id = null) {
            if ($id != null) {
                $result = $this->update($id, $data);
                return $result ? true : 'Data not updated: Update failed.';
            } else {
                $result = $this->insert($data);
                if ($result) {
                    return $result ? true : 'Data not updated: Update failed.';
                } else {
                    return 'Data not inserted: Insertion failed.';
                }
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
        public function get_assign_data($id){
            return $this->where('id',$id)->findAll();
           
        }
        
    }
?>