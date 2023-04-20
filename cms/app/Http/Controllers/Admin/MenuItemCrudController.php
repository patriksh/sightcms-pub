<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;

class MenuItemCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ReorderOperation;
    use PermissionCheckTrait;
    
    // Basic CRUD settings.
    public function setup()
    {
        $this->crud->setModel('App\Models\MenuItem');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/menu-item');
        $this->crud->setEntityNameStrings(__('menu item'), __('menu items'));
        $this->setupAccessByPermissions();
    }

    // Setup list operaton (load columns).
    protected function setupListOperation()
    {
        $this->crud->orderBy('lft', 'DESC');

        $this->crud->addColumn([
            'name' => 'name',
            'label' => __('Label'),
        ]);

        $this->crud->addColumn([
            'label' => __('Parent'),
            'type' => 'select',
            'name' => 'parent_id',
            'entity' => 'parent',
            'attribute' => 'name',
            'model' => '\App\Models\MenuItem',
        ]);
    }

    // Setup create operation (load fields).
    protected function setupCreateOperation()
    {
        $this->crud->addField([
            'name' => 'name',
            'label' => __('Label'),
        ]);

        $this->crud->addField([
            'label' => __('Parent'),
            'type' => 'select',
            'name' => 'parent_id',
            'entity' => 'parent',
            'attribute' => 'name',
            'model' => '\App\Models\MenuItem',
        ]);

        $this->crud->addField([
            'name' => ['type', 'link', 'page_id'],
            'label' => __('Type'),
            'type' => 'page_or_link',
            'page_model' => '\App\Models\Page',
            'view_namespace' => file_exists(resource_path('views/vendor/backpack/crud/fields/page_or_link.blade.php')) ? null : 'menucrud::fields',
        ]);
    }

    // Setup update operation (same as create).
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    // Setup reorder operation. Do not allow nesting.
    protected function setupReorderOperation()
    {
        $this->crud->set('reorder.label', 'name');
        $this->crud->set('reorder.max_level', 1);
    }
}
