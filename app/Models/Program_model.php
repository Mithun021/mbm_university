<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Program_model extends Model
    {
        protected $table         = 'program_category';
        protected $primaryKey = 'id';
        protected $allowedFields = ['name','description','status','upload_by'];
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

        public function getProgramCategoriesByDepartment($departmentId) {
            $sql = "
                SELECT program_category.id as program_id, program_category.name as program_name,pargram_department_mapping.batch_start,pargram_department_mapping.batch_end 
                FROM program_category 
                LEFT JOIN pargram_department_mapping ON program_category.id = pargram_department_mapping.program_id 
                WHERE pargram_department_mapping.department_id = $departmentId
                AND program_category.status = 1 
                AND pargram_department_mapping.status = 1
            ";
            $query = $this->db->query($sql);
            return $query->getResultArray();

        }
        
        public function getProgramWithBatch($iId) {
            $sql = "
                SELECT program_category.name as program_name,pargram_department_mapping.batch_start,pargram_department_mapping.batch_end 
                FROM program_category 
                LEFT JOIN pargram_department_mapping ON program_category.id = pargram_department_mapping.program_id 
                WHERE program_category.id = $iId
            ";
            $query = $this->db->query($sql);
            return $query->getRowArray();

        }
        
    }
?>