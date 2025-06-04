<?php
    namespace App\Models;
    use CodeIgniter\Model;
    class Permission_model extends Model
    {
        protected $table         = 'module_permission';
        protected $primaryKey = 'id';
        protected $allowedFields = ['emplyee_id','module_cat_id','view_permission','add_permission','edit_permission','delete_permission'];

        public function manage_permission($data, $add_type_name, $status)
        {
            // Check if the record already exists in the database
            $existing_permission = $this->db->table('module_permission')
                ->where('emplyee_id', $data['emplyee_id'])
                ->where('module_cat_id', $data['module_cat_id'])
                ->get()
                ->getRowArray();

            if ($existing_permission) {
                // Data exists, so update the permissions based on $add_type_name
                switch ($add_type_name) {
                    case 'view':
                        $this->db->table('module_permission')
                            ->where('emplyee_id', $data['emplyee_id'])
                            ->where('module_cat_id', $data['module_cat_id'])
                            ->update(['view_permission' => $status]);
                        break;
                    case 'add':
                        $this->db->table('module_permission')
                            ->where('emplyee_id', $data['emplyee_id'])
                            ->where('module_cat_id', $data['module_cat_id'])
                            ->update(['add_permission' => $status]);
                        break;
                    case 'edit':
                        $this->db->table('module_permission')
                            ->where('emplyee_id', $data['emplyee_id'])
                            ->where('module_cat_id', $data['module_cat_id'])
                            ->update(['edit_permission' => $status]);
                        break;
                    case 'delete':
                        $this->db->table('module_permission')
                            ->where('emplyee_id', $data['emplyee_id'])
                            ->where('module_cat_id', $data['module_cat_id'])
                            ->update(['delete_permission' => $status]);
                        break;
                    default:
                        return false;
                }
            } else {
                // Data does not exist, so insert a new record
                $insert_data = [
                    'emplyee_id' => $data['emplyee_id'],
                    'module_cat_id' => $data['module_cat_id']
                ];

                // Set the permission field based on the $add_type_name
                switch ($add_type_name) {
                    case 'view':
                        $insert_data['view_permission'] = $status;
                        break;
                    case 'add':
                        $insert_data['add_permission'] = $status;
                        break;
                    case 'edit':
                        $insert_data['edit_permission'] = $status;
                        break;
                    case 'delete':
                        $insert_data['delete_permission'] = $status;
                        break;
                    default:
                        return false;
                }

                // Insert the new permission data
                $this->db->table('module_permission')->insert($insert_data);
            }

            return true;
        }

        public function get_by_employee_and_module_id($emp_id,$module_cat_id){
            return $this->where('emplyee_id',$emp_id)
                        ->where('module_cat_id',$module_cat_id)->first();
        }
        
    }
?>