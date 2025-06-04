<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Mapping_question_model extends Model
    {
        protected $table         = 'mapping_questions';
        protected $primaryKey = 'id';
        protected $allowedFields = ['question_type_id','title','description','correct_answer','upload_by'];
        // protected $createdField  = 'created_at';

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

        public function getByQuestionType($id){
            return $this->where('question_type_id',$id)->orderBy('id','asc')->findAll();
        }

    }
?>