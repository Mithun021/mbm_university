<?php

use App\Models\Employee_model;
use App\Models\Module_category_model;
use App\Models\Module_roles_model;
use App\Models\Permission_model;
use App\Models\Roles_model;
use CodeIgniter\Modules\Modules;
function has_permission($user_id, $permission_name)
{
    // Load necessary models
    $employee_model = new Employee_model();
    $roles_model = new Roles_model();
    $module_roles_model = new Module_roles_model();

    // Get user info
    $user = $employee_model->find($user_id);

    // Admin has full access
    if ($user && isset($user['authority']) && $user['authority'] === 'admin') {
        return true;
    }

    // Find module permission by type
    $module_permission = $roles_model->where('type', $permission_name)->first();

    // If the permission type doesn't exist, deny access
    if (!$module_permission || !isset($module_permission['id'])) {
        return false;
    }

    // Check if user has active permission for this module
    $has_permission = $module_roles_model->where('employee_id', $user_id)
        ->where('module_id', $module_permission['id'])
        ->where('status', 1)
        ->first();

    return $has_permission ? true : false;
}


?>