<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Module_category_model extends Model
    {
        protected $table         = 'module_category';
        protected $primaryKey = 'id';
        protected $allowedFields = ['name','module_id','c_view','c_add','c_edit','c_delete'];

        public function get_by_module_id($id){
            return $this->where('module_id',$id)->findAll();
        }
        
    }
?>