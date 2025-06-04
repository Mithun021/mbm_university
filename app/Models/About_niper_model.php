<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class About_niper_model extends Model
    {
        protected $table         = 'about_niper';
        protected $primaryKey = 'id';
        protected $allowedFields = ['title','description','vision','mission','objective','banner_photo'];
        protected $updatedField  = 'updated_at';

        public function add($data, $id) {
            $result = $this->update($id, $data);
            return $result ? true : 'Data not updated: Update failed.';
        }

        public function get($id){
            return $this->where('id', $id)->first();
        } 
        
    }
?>