<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Employee_patent_model extends Model
    {
        protected $table         = 'employee_patent';
        protected $primaryKey = 'id';
        protected $allowedFields = ['employee_id','patent_title','patent_number','patent_level','awards_date','fund_generated','document_file','patent_status','upload_by'];
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