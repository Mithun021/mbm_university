<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Download_form_model extends Model
    {
        protected $table         = 'download_forms';
        protected $primaryKey = 'id';
        protected $allowedFields = ['title','description','upload_file','status','upload_by'];
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
                $result = $this->orderBy('title','asc')->findAll();
            }
            return $result;
        }
    }
?>