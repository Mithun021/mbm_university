<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Research_publication_model extends Model
    {
        protected $table         = 'research_publication';
        protected $primaryKey = 'id';
        protected $allowedFields = ['title','description','thumbnail','reseach_publication_type_id','impact_factor','faculty_name','patent_no','issn_no','isbn_no','doi_no','department_id','upload_by'];
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