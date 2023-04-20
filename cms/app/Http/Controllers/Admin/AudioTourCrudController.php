<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

class AudioTourCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use PermissionCheckTrait;

    // Basic CRUD settings.
    public function setup()
    {
        $this->crud->setModel(\App\Models\AudioTour::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/audio-tour');
        $this->crud->setEntityNameStrings(__('audio tour'), __('audio tours'));
        $this->setupAccessByPermissions();
    }

    // Setup list operation (load columns).
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'label' => __('Title'),
            'name' => 'title'
        ]);

        $this->crud->addColumn([
            'label' => __('Duration'),
            'name' => 'duration'
        ]);

        // Add a button for viewing the audio tour on frontend.
        $this->crud->addButtonFromView('line', 'view', 'view', 'beginning');
    }

    // Setup create operation (load fields).
    protected function setupCreateOperation()
    {
        $this->crud->setValidation([
            'title' => 'required|min:2',
            'file' => 'nullable|mimes:mp3,wav',
        ]);

        $this->crud->addField([
            'label' => __('Title'),
            'type' => 'text',
            'name' => 'title'
        ]);

        $this->crud->addField([
            'label' => __('Audio file'),
            'name' => 'file',
            'type' => 'upload',
            'upload' => true
        ]);

        $this->crud->addField([
            'label' => __('Content'),
            'name' => 'content',
            'type' => 'wysiwyg'
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
