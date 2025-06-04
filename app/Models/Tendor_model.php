<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Tendor_model extends Model
    {
        protected $table         = 'tendor_detail';
        protected $primaryKey = 'id';
        protected $allowedFields = ['tendor_title','tendor_description','tendor_ref_no','bidding_date','bidding_time','tendor_start_date','tendor_start_time','tendor_end_date','tendor_end_time', 'upload_file' ,'tendor_status','marquee_status','status','upload_by'];
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