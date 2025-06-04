<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Instruments_model extends Model
    {
        protected $table         = 'instruments';
        protected $primaryKey = 'id';
        protected $allowedFields = ['title','description','upload_file','department_id','upload_by'];
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
                $result = $this->orderBy('title','asc')->findAll();
            }
            return $result;
        }

        public function getInstrumentByDepartment($id){
            return $this->where('department_id',$id)->findAll();
        }

    }
?>