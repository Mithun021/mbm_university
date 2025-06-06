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

    // Get employee
    $user = $employee_model->find($user_id);
    if (!$user) {
        return false;
    }

    // Admin has full access
    if ($user['authority'] === 'admin') {
        return true;
    }

    // Check menu heading access
    if ($access_type === null) {
        $module = $roles_model->where('type', $permission_name)->first();
        if (!$module) return false;

        $module_permission = $module_roles_model
            ->where('employee_id', $user_id)
            ->where('module_id', $module['id'])
            ->where('status', 1)
            ->first();

        return $module_permission ? true : false;
    }

    // Check submenu (view/add/edit/delete) access
    $module_category = $module_category_model->where('type', $permission_name)->first();
    if (!$module_category) return false;

    $permission_model
        ->where('emplyee_id', $user_id)
        ->where('module_cat_id', $module_category['id']);

    switch ($access_type) {
        case 'view':
            $permission_model->where('view_permission', 1);
            break;
        case 'add':
            $permission_model->where('add_permission', 1);
            break;
        case 'edit':
            $permission_model->where('edit_permission', 1);
            break;
        case 'delete':
            $permission_model->where('delete_permission', 1);
            break;
        default:
            return false;
    }

    $permission_data = $permission_model->first();
    return $permission_data ? true : false;
}
