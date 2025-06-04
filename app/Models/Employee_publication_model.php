<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Employee_publication_model extends Model
    {
        protected $table         = 'employee_publication';
        protected $primaryKey = 'id';
        protected $allowedFields = ['emplyee_id','title','description','keywords','publication_photo','published_name','volume_number','publish_date_online','publish_date_print','date_of_acceptance','date_of_communication','doi_details','publication_year','journal_name','page_no','reffered','issn_no','isbn_no','impact_factor','web_link','publication_type','status','publication_role','upload_by'];
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
                $result = $this->orderBy('emplyee_id','asc')->findAll();
            }
            return $result;
        }

        
        
    }
?>