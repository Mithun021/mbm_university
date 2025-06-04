<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Program_department_mapping_model extends Model
    {
        protected $table         = 'pargram_department_mapping';
        protected $primaryKey = 'id';
        protected $allowedFields = ['program_id','department_id','eligibility_criteria','no_of_seats','batch_start','batch_end','syllabus_files','current_session','status','admission','upload_by'];
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
                $result = $this->findAll();
            }
            return $result;
        }

        public function activeData() {
            return $this->where('status',1)->findAll();
        }

        public function getBatchName($prog_id,$depart_id){
            return $this->where('program_id',$prog_id)->where('department_id',$depart_id)->first();
        }
        
    }
?>