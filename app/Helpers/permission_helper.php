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

    // Get employee record
    $user = $employee_model->find($user_id);

    if (!$user) {
        return false; // No such user
    }

    // Allow all access to admin
    if ($user['authority'] === 'admin') {
        return true;
    }

    // Get module (permission) by type
    $module = $roles_model->where('type', $permission_name)->first();
    if (!$module || !isset($module['id'])) {
        return false;
    }

    // Check basic module permission (module_roles)
    $module_permission = $module_roles_model
        ->where('employee_id', $user_id)
        ->where('module_id', $module['id'])
        ->where('status', 1)
        ->first();

    if (!$module_permission) {
        return false; // No access to module
    }

    // If no specific access_type is being requested, basic permission is enough
    if ($access_type === null && $access_type == 'view') {
        return true;
    }

    // Check specific permission in module_category and permission table
    // $module_category = $module_category_model
    //     ->where('sort_parameter', $permission_name)
    //     ->where('module_id', $module['id'])
    //     ->first();

    // if (!$module_category || !isset($module_category['id'])) {
    //     return false;
    //     // echo $module_category['id']; die;
    // }

    // if ($access_type === "view") {
    // // Build specific permission query
    //     $permission_data = $permission_model->where('module_cat_id', $module_category['id'])
    //                     ->where('emplyee_id', $user_id)
    //                     ->where('view_permission', 1);
    //     return $permission_data ? true : false;
    // }
}
