<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Private_research_lab_model extends Model
    {
        protected $table         = 'private_research_lab';
        protected $primaryKey = 'id';
        protected $allowedFields = ['title','description','upload_photo','upload_file','instrument_id','upload_by'];
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
                $result = $this->orderBy('instrument_id','asc')->findAll();
            }
            return $result;
        }
    }
?>