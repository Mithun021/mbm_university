<?php

use App\Models\Employee_model;
use App\Models\Roles_model;
use App\Models\Module_roles_model;
use App\Models\Module_category_model;
use App\Models\Permission_model;

function has_permission($user_id, $permission_name, $access_type = null)
{
    $employee_model         = new Employee_model();
    $roles_model            = new Roles_model();
    $module_roles_model     = new Module_roles_model();

    // Get employee record
    $user = $employee_model->find($user_id);
    if (!$user) {
        return false;
    }

    // Allow all access to admin
    if ($user['authority'] === 'admin') {
        return true;
    }

    // Get module (permission)
    $module = $roles_model->where('type', $permission_name)->first();
    if (!$module || !isset($module['id'])) {
        return false;
    }

    // Get module permission for employee
    $module_permission = $module_roles_model
        ->where('employee_id', $user_id)
        ->where('module_id', $module['id'])
        ->where('status', 1)
        ->first();

    if (!$module_permission) {
        return false;
    }

    // Check if only view access is needed
    if ($access_type === null || $access_type === 'view') {
        return true;
    }

    // Future logic for 'edit', 'delete', etc., can go here

    return false;
}
