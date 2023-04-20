<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

class BikeRouteCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use PermissionCheckTrait;

    // Basic CRUD settings.
    public function setup()
    {
        $this->crud->setModel(\App\Models\BikeRoute::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/bike-route');
        $this->crud->setEntityNameStrings(__('bike route'), __('bike routes'));
        $this->setupAccessByPermissions();
    }

    // Setup list operation (load columns).
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'label' => __('Title'),
            'name' => 'title'
        ]);

        // Add a button for viewing the bike route on frontend.
        $this->crud->addButtonFromView('line', 'view', 'view', 'beginning');
    }

    // Setup create operation (load fields).
    protected function setupCreateOperation()
    {
        $this->crud->setValidation([
            'title' => 'required|min:2',
            'file' => 'required'
        ]);

        $this->crud->addField([
            'label' => __('Title'),
            'type' => 'text',
            'name' => 'title'
        ]);

        $this->crud->addField([
            'label' => __('Cover image'),
            'name' => 'image',
            'type' => 'upload_with_preview',
            'upload' => true
        ]);
    }

    // Setup update operation (same as create).
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
