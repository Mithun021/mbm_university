<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Act_rules_model extends Model
    {
        protected $table         = 'act_rules';
        protected $primaryKey = 'id';
        protected $allowedFields = ['rules_type','rules_title','rules_description','upload_file','act_rules_date','status','upload_by'];
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
                $result = $this->orderBy('rules_type','asc')->findAll();
            }
            return $result;
        }
    }
?>