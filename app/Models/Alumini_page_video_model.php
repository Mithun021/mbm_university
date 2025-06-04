<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Alumini_page_video_model extends Model
    {
        protected $table         = 'alumini_page_video';
        protected $primaryKey = 'id';
        protected $allowedFields = ['title','description','video_date','video_link','file_upload','upload_by'];
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