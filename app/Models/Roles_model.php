<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Roles_model extends Model
    {
        protected $table         = 'module';
        protected $primaryKey = 'id';
        protected $allowedFields = ['name','type','status'];

        public function get($id = null){
            if($id != null){
                $result = $this->where('id',$id)->first();
            }else{
                $result = $this->findAll();
            }
            return $result;
        }
        
    }
?>