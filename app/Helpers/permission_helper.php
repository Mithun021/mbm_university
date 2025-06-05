<?php

use App\Models\Employee_model;
use App\Models\Module_category_model;
use App\Models\Module_roles_model;
use App\Models\Permission_model;
use App\Models\Roles_model;

function has_permission($user_id, $permission_name, $access_type = null)
{
    // Load models
    $employee_model         = new Employee_model();
    $roles_model            = new Roles_model();
    $module_roles_model     = new Module_roles_model();
    $module_category_model  = new Module_category_model();
    $permission_model       = new Permission_model();

    // Get user data
    $user = $employee_model->find($user_id);

    // Grant all access if user is admin
    if ($user && isset($user['authority']) && $user['authority'] === 'admin') {
        return true;
    }

    // Get the module by permission name (type)
    $module = $roles_model->where('type', $permission_name)->first();

    if (!$module || !isset($module['id'])) {
        return false;
    }

    // Check if user has access to this module
    $module_permission = $module_roles_model->where('employee_id', $user_id)
        ->where('module_id', $module['id'])
        ->where('status', 1)
        ->first();

    if (!$module_permission) {
        return false;
    }

    // Optional: Check access via module category and sort_parameter
    if ($access_type !== null) {
        $module_category = $module_category_model
            ->where('sort_parameter', $permission_name)
            ->where('module_id', $module['id'])
            ->first();

        if (!$module_category || !isset($module_category['id'])) {
            return false;
        }

        // Check if the user has the specific permission for this module category
        $permission_model->where('module_cat_id', $module_category['id'])
                 ->where('emplyee_id', $user_id);

        if ($access_type === 'view') {
            $permission_model->where('view_permission', 1);
        } 
        if ($access_type === 'add') {
            $permission_model->where('add_permission', 1);
        } 
        if ($access_type === 'edit') {
            $permission_model->where('edit_permission', 1);
        } 
        if ($access_type === 'delete') {
            $permission_model->where('delete_permission', 1);
        }

        $permission_data = $permission_model->first();
        if (!$permission_data) {
            return false;
        }


    }

    return true;
}
