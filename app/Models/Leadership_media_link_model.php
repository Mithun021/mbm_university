<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Leadership_media_link_model extends Model
    {
        protected $table         = 'leadership_media_link';
        protected $primaryKey    = 'id';
        protected $allowedFields = ['name','designition', 'upload_file', 'description', 'link_url', 'facebook_link', 'instagram_link', 'twitter_link', 'youtube_link', 'linkedin_link', 'upload_by'];
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
    }
?>
