<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Books_chapter_model extends Model
    {
        protected $table         = 'book_chapter';
        protected $primaryKey = 'id';
        protected $allowedFields = ['emplyee_id','book_chapter','title','publisher','level','total_pages','publich_date_online','publich_date_print','acceptance_date','communication_date','month','isbn','issn_no','doi','web_link','upload_file','upload_by'];
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