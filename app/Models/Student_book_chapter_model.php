<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Student_book_chapter_model extends Model
    {
        protected $table         = 'student_book_chapter';
        protected $primaryKey = 'id';
        protected $allowedFields = ['student_id','chapter_title','book_title','publication_description','publisher_name','volume_number','page_number','issn_no','isbn_no','doi','impact_factor','publication_year','file_upload'];
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
                $result = $this->orderBy('id','desc')->findAll();
            }
            return $result;
        }
        public function getByStudent($id){
            return $this->where('student_id',$id)->findAll();
        }
    }
?>
