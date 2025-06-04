<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Adjunt_faculty_notification_model extends Model
    {
        protected $table         = 'adjunt_faculty_notification';
        protected $primaryKey = 'id';
        protected $allowedFields = ['notification_title','notification_description','notification_date','notification_file','notification_marquee','upload_by'];
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