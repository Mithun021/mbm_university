<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Company_contact_person_model extends Model
    {
        protected $table         = 'company_contact_person';
        protected $primaryKey = 'id';
        protected $allowedFields = ['company_name','contact_name','contact_designation','linkedin','facebook','instagram','twitter','email_1','email_2','helpline_number1','helpline_number2','upload_by'];
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
        public function getByCompany($id){
            return $this->orderBy('id','asc')->findAll();
        }
    }
?>