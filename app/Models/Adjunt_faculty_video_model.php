<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Adjunt_faculty_video_model extends Model
    {
        protected $table         = 'adjunt_faculty_video';
        protected $primaryKey = 'id';
        protected $allowedFields = ['video_title','video_description','video_file','video_venue','video_datetime','upload_by'];
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