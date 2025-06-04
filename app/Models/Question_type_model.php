<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Question_type_model extends Model
    {
        protected $table         = 'question_type';
        protected $primaryKey    = 'id';
        protected $allowedFields = ['title','description','status','upload_by'];
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
            if ($id !== null) {
                if (is_array($id)) {
                    return $this->whereIn('id', $id)->findAll(); // Fetch multiple question types
                } else {
                    return $this->where('id', $id)->first(); // Fetch a single question type
                }
            } else {
                return $this->orderBy('id', 'asc')->findAll();
            }
        }
        public function getActiveQuestion(){
            return $this->where('status',1)->findAll();
        }
    }
?>
