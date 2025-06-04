<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Result_grade_notes_model extends Model
    {
        protected $table         = 'result_grade_footer_notice';
        protected $primaryKey    = 'id';
        protected $allowedFields = ['result_notice','grade_notice'];
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
                $result = $this->orderBy('id','desc')->findAll();
            }
            return $result;
        }
    }
?>
