<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Patent_webpage_file_model extends Model
    {
        protected $table         = 'patent_webpage_file';
        protected $primaryKey = 'id';
        protected $allowedFields = ['patent_webpage_id','upload_file'];
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
                $result = $this->orderBy('id','desc')->findAll();
            }
            return $result;
        }

        public function get_by_webpage($webpageid){
           return $this->where('patent_webpage_id',$webpageid)->findAll();
        }
    }
?>