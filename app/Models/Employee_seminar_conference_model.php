<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Employee_seminar_conference_model extends Model
    {
        protected $table         = 'employee_seminar_conference';
        protected $primaryKey = 'id';
        protected $allowedFields = ['employee_id','type_of_activity','other_activity','seminar_name','from_date','to_date','role','designation','level','start_date','end_date','no_of_participant','funding_agency_name','fund_amount','upload_by'];
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