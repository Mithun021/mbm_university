<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Instrument_rates_model extends Model
    {
        protected $table         = 'instruments_rates';
        protected $primaryKey = 'id';
        protected $allowedFields = ['instrument_id','experiment_name','govt_rate','industry_rate','upload_by'];
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
                $result = $this->orderBy('instrument_id','asc')->findAll();
            }
            return $result;
        }
    }
?>