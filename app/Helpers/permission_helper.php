<?php

use App\Models\Employee_model;
use App\Models\Module_category_model;
use App\Models\Module_roles_model;
use App\Models\Permission_model;
use App\Models\Roles_model;
use CodeIgniter\Modules\Modules;
function has_permission($user_id, $permission_name)
{
    $employee_model = new Employee_model();
    $user = $employee_model->find($user_id);

    // Admin gets all access
    if ($user && $user['authority'] === 'admin') {
        return true;
    }

    $modules_model = new Roles_model();
    $module_category_model = new Module_category_model();
    $module_roles_model = new Module_roles_model();
    $permission_model = new Permission_model();


    $module_premission = $modules_model->where('type', $permission_name)->first();
    return $module_premission ? true : false;






}

?>