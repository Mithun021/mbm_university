<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Act_rules_category_model extends Model
    {
        protected $table         = 'act_rules_category';
        protected $primaryKey    = 'id';
        protected $allowedFields = ['name', 'status' , 'upload_by'];
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

        public function getActiveData(){
            return $this->where('status',1)->orderBy('name','asc')->findAll();
        }
    }
?>
