<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Facility_notification_model extends Model
    {
        protected $table         = 'facility_notification';
        protected $primaryKey    = 'id';
        protected $allowedFields = ['facility_id','section_id','title','description','puslish_date','web_link','upload_file','marquee_status','upload_by'];
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
