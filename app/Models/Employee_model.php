<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Employee_model extends Model
    {
        protected $table         = 'employees';
        protected $primaryKey = 'id';
        protected $allowedFields = ['employee_unique_id','sir_name','first_name','middle_name','last_name','bloods_group','gender','material_status','designation_id','department_id','mobile_no','alternate_mobile_no','landline_no','official_mail','personal_mail','caste','ews','religion','post_charge','employee_type','profile_photo','resume_file','employee_nature','twitter','facebook','linkedin','research','google_h_index','i10_index','scopus_h_index','password','status','authority','joining_date','employee_status','relieving_date','research_gate_id','orcid_id','google_scholar_id','vidwan','upload_by'];
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

        public function getEmployeeDetailsByIds(array $empIds) {
            return $this->whereIn('id', $empIds)->findAll();
        }
        
    }
?>