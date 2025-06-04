<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Instrument_slots_master_model extends Model
    {
        protected $table         = 'instrument_slots_master';
        protected $primaryKey = 'id';
        protected $allowedFields = ['booking_slot_date','booking_slot_day','department_id','instrument_id','user_type','booking_start_time','booking_end_time','number_of_slots','upload_by'];
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
                $result = $this->orderBy('booking_slot_date','asc')->findAll();
            }
            return $result;
        }

        public function getInstrumentByDepartment($id){
            return $this->where('department_id',$id)->findAll();
        }

    }
?>