<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Tendor_corrigendum_model extends Model
    {
        protected $table         = 'tendor_corigendum';
        protected $primaryKey    = 'id';
        protected $allowedFields = ['tendor_id','upload_file', 'file_decription', 'upload_by'];
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
        public function get_by_tendorid($id){
            return $this->where('tendor_id', $id)->first();
        }
    }
?>
