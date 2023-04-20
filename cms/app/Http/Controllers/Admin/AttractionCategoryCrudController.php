<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\Admin\Operations\InlineCreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;

class AttractionCategoryCrudController extends CrudController
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
        $this->crud->setModel(\App\Models\AttractionCategory::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/attraction-category');
        $this->crud->setEntityNameStrings(__('attraction category'), __('attraction categories'));
        $this->setupAccessByPermissions();
    }

    // Setup list operaton (load columns).
    protected function setupListOperation()
    {
        $this->crud->orderBy('lft', 'DESC');

        $this->crud->column('name');

        // Add a button for viewing the category on frontend.
        $this->crud->addButtonFromView('line', 'view', 'view_category', 'beginning');
    }

    // Setup create operation (load fields).
    protected function setupCreateOperation()
    {
        $this->crud->setValidation([
            'name' => 'required|min:2',
        ]);

        $this->crud->field('name');

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
