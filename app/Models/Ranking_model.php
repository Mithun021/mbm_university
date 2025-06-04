<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Ranking_model extends Model
    {
        protected $table         = 'ranking_details';
        protected $primaryKey = 'id';
        protected $allowedFields = ['ranking_type','other_ranking','description','ranking_year','ranking_category','other_ranking_category','ranking_number','upload_file','datasubmittedpharmacy','datasubmittedoverall','pharmacy_file','overall_file','upload_by'];
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