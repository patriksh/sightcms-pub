<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

class EventCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use PermissionCheckTrait;

    // Basic CRUD settings.
    public function setup()
    {
        $this->crud->setModel(\App\Models\Event::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/event');
        $this->crud->setEntityNameStrings(__('event'), __('events'));
        $this->setupAccessByPermissions();

        // Add a button for viewing the event on frontend.
        $this->crud->addButtonFromView('line', 'view', 'view', 'beginning');
    }

    // Setup list operaton (load columns).
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'label' => __('Title'),
            'name' => 'title'
        ]);

        $this->crud->addColumn([
            'label' => __('Location'),
            'name' => 'location'
        ]);

        $this->crud->addColumn([
            'label' => __('Starting date'),
            'name' => 'date_from',
            'type' => 'datetime'
        ]);

        $this->crud->addColumn([
            'label' => __('Ending date'),
            'name' => 'date_to',
            'type' => 'datetime'
        ]);
    }

    // Setup create operation (load fields).
    protected function setupCreateOperation()
    {
        $this->crud->setValidation([
            'title' => 'required|min:2',
            'location' => 'required',
            'date_from' => 'required'
        ]);

        $this->crud->addField([
            'label' => __('Title'),
            'type' => 'text',
            'name' => 'title'
        ]);

        $this->crud->addField([
            'label' => __('Location'),
            'type' => 'address_google',
            'name' => 'location'
        ]);

        $this->crud->addField([
            'label' => __('Starting date'),
            'type' => 'datetime',
            'name' => 'date_from',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'label' => __('Ending date'),
            'type' => 'datetime',
            'name' => 'date_to',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'label' => __('Content'),
            'name' => 'content',
            'type' => 'wysiwyg'
        ]);

        $this->crud->addField([
            'label' => __('Logo'),
            'name' => 'logo',
            'type' => 'upload_with_preview',
            'upload' => true,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'label' => __('Cover image'),
            'name' => 'image',
            'type' => 'upload_with_preview',
            'upload' => true,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'label' => __('Website link'),
            'type' => 'url',
            'name' => 'website_link'
        ]);
    }

    // Setup update operation (same as create).
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
