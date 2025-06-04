<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Contact_model extends Model
    {
        protected $table         = 'contact';
        protected $primaryKey = 'id';
        protected $allowedFields = ['contact_address','contact1','contact1_desc','contact2','contact2_desc','contact3','contact3_desc','email_id1','email_id2','working_days','working_hours'];
        protected $updatedField  = 'updated_at';

        public function add($data, $id) {
            $result = $this->update($id, $data);
            return $result ? true : 'Data not updated: Update failed.';
        }

        public function get($id){
            return $this->where('id', $id)->first();
        } 
        
    }
?>