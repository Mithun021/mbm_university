<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Placement_company_detail_model extends Model
    {
        protected $table         = 'placement_company_detail';
        protected $primaryKey = 'id';
        protected $allowedFields = ['company_name','company_logo','company_photo','company_profile','company_website','linkedin','facebook','instagram','twitter','email_1','email_2','helpline_number1','helpline_number2','upload_by'];
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