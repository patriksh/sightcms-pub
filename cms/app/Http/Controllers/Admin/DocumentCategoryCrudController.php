<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Operations\InlineCreateOperation;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;

class DocumentCategoryCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ReorderOperation;
    use InlineCreateOperation;
    use PermissionCheckTrait;

    // Basic CRUD settings.
    public function setup()
    {
        $this->crud->setModel(\App\Models\DocumentCategory::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/document-category');
        $this->crud->setEntityNameStrings(__('document category'), __('document categories'));
        $this->setupAccessByPermissions();

        // Add a button for viewing the category on frontend.
        $this->crud->addButtonFromView('line', 'view', 'view_category', 'beginning');
    }

    // Setup list operaton (load columns).
    protected function setupListOperation()
    {
        $this->crud->orderBy('lft', 'DESC');

        $this->crud->addColumn([
            'label' => __('Name'),
            'name' => 'name'
        ]);

        $this->crud->addColumn([
            'label' => __('Icon'),
            'name' => 'icon',
            'type' => 'icon'
        ]);
    }

    // Setup create operation (load fields).
    protected function setupCreateOperation()
    {
        $this->crud->setValidation([
            'name' => 'required|min:2'
        ]);

        $this->crud->addField([
            'label' => __('Name'),
            'type' => 'text',
            'name' => 'name'
        ]);
        
        $this->crud->addField([
            'label' => __('Icon'),
            'type' => 'icon_picker',
            'name' => 'icon'
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
