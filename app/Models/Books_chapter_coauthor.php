<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Books_chapter_coauthor extends Model
    {
        protected $table         = 'books_chapter_coauthor';
        protected $primaryKey = 'id';
        protected $allowedFields = ['books_chapter_id','coauthor_name'];
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
        
    }
?>