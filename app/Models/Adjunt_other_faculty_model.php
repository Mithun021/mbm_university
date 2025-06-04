<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Adjunt_other_faculty_model extends Model
    {
        protected $table         = 'adjunt_other_faculty';
        protected $primaryKey = 'id';
        protected $allowedFields = ['annotation','first_name','middle_name','last_name','designation','organisation_name','organisation_address','personal_email','official_email','mobile','linkedin','twitter','facebook','research_interest','description','photo','resume','faculty_type','adjunt_faculty_webpage_id','status','upload_by'];
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