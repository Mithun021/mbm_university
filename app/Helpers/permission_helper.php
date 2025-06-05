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
    $module_category_model  = new Module_category_model();
    $permission_model       = new Permission_model();

    $user = $employee_model->find($user_id);
    if (!$user) {
        return false;
    }

    if ($user['authority'] === 'admin') {
        return true;
    }

    $module = $roles_model->where('type', $permission_name)->first();
    if (!$module || !isset($module['id'])) {
        return false;
    }

    $module_permission = $module_roles_model
        ->where('employee_id', $user_id)
        ->where('module_id', $module['id'])
        ->where('status', 1)
        ->first();

    if (!$module_permission) {
        return false;
    }

    // ✅ Allow if access_type is null or 'view'
    if ($access_type === null || $access_type === 'view') {
        return true;
    }

    // Additional access type logic (e.g., 'edit', 'delete') can be added here

    return false;
}
