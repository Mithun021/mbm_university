<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Photo_album_file_model extends Model
    {
        protected $table         = 'photo_album_file';
        protected $primaryKey = 'id';
        protected $allowedFields = ['album_id','file_name'];

        public function add($data, $id = null) {
            if ($id != null) {
                $result = $this->update($id, $data);
                return $result ? true : 'Data not updated: Update failed.';
            } else {
                $result = $this->insert($data);
                return $result;
            }
        }

        public function get($id = null){
            if($id != null){
                $result = $this->where('id',$id)->first();
            }else{
                $result = $this->findAll();
            }
            return $result;
        } 

        public function getByAlbumId($id){
             return $this->orderBy('id','asc')->findAll();
            
        } 
        
    }
?>