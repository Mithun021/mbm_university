<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Newsletter_model extends Model
    {
        protected $table         = 'newsletter';
        protected $primaryKey = 'id';
        protected $allowedFields = ['title','description','upload_image','upload_file','start_month','start_year','end_month','end_year','upload_by'];
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