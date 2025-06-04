<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Manage_question_model extends Model
    {
        protected $table         = 'manage_question';
        protected $primaryKey    = 'id';
        protected $allowedFields = ['form_section_id','question_type','question_details_id','answer_option','title','descripition'];
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
        public function getBYformId($id){
            return $this->where('form_section_id',$id)->findAll();
        }
    }
?>
