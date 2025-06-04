<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Photo_album_model extends Model
    {
        protected $table         = 'photo_album';
        protected $primaryKey = 'id';
        protected $allowedFields = ['album_title','upload_by'];
        protected $createdField  = 'created_at';

        public function add($data, $id = null) {
            if ($id != null) {
                $result = $this->update($id, $data);
                return $result ? true : 'Data not updated: Update failed.';
            } else {
                $result = $this->insert($data);
                if ($result) {
                    return $this->insertID(); // Return the inserted record's ID
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
        
    }
?>