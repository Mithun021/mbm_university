<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Convocation_session_model extends Model
    {
        protected $table         = 'convocation_session';
        protected $primaryKey    = 'id';
        protected $allowedFields = ['convocation_id','session_start', 'session_end'];
        // protected $createdField  = 'created_at';

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

        public function get_by_conv_id($id){
            return $this->where('convocation_id',$id)->findAll();
        }
    }
?>
