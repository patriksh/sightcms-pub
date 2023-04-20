<?php

namespace App\Http\Controllers\Admin;

trait PermissionCheckTrait
{
    // Sets up CRUD access based on spatie/laravel-permissions.
    public function setupAccessByPermissions()
    {
        $prefix = $this->crud->entity_name;

        // e.g. checks for article.* or article.create
        if(!backpack_user()->hasPermissionTo($prefix . '.create')) {
            $this->crud->denyAccess('create');
        }

        if(!backpack_user()->hasPermissionTo($prefix . '.update')) {
            $this->crud->denyAccess('update');
        }

        if(!backpack_user()->hasPermissionTo($prefix . '.delete')) {
            $this->crud->denyAccess('delete');
        }
    }
}
