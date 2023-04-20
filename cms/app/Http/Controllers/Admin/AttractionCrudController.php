<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Operations\FetchOperation;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

class AttractionCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use FetchOperation;
    use PermissionCheckTrait;

    // Basic CRUD settings.
    public function setup()
    {
        $this->crud->setModel(\App\Models\Attraction::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/attraction');
        $this->crud->setEntityNameStrings(__('attraction'), __('attractions'));
        $this->setupAccessByPermissions();

        // Add a button for viewing the attraction on frontend.
        $this->crud->addButtonFromView('line', 'view', 'view', 'beginning');
    }

    // Setup list operaton (load columns).
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'label' => __('Name'),
            'name' => 'name'
        ]);

        $this->crud->addColumn([
            'label' => __('Category'),
            'name' => 'attraction_category.name'
        ]);

        $this->crud->addColumn([
            'label' => __('Location'),
            'name' => 'location'
        ]);

        // Add a button for attraction categories (they aren't in the sidebar).
        $this->crud->addButtonFromView('top', 'categories', 'categories', 'end');

        // Add a button for attraction preferences (they aren't in the sidebar).
        $this->crud->addButtonFromView('top', 'preferences', 'preferences', 'end');

        // Add a button for viewing the attraction on frontend.
        $this->crud->addButtonFromView('line', 'view', 'view', 'beginning');
    }

    // Setup create operation (load fields).
    protected function setupCreateOperation()
    {
        $this->crud->setValidation([
            'name' => 'required|min:2',
            'attraction_category_id' => 'required',
            'location' => 'required',
        ]);

        $this->crud->addField([
            'label' => __('Name'),
            'type' => 'text',
            'name' => 'name'
        ]);

        $this->crud->addField([
            'label' => __('Category'),
            'type' => 'relationship',
            'name' => 'attraction_category_id',
            'entity' => 'attraction_category',
            'model' => 'App\Models\AttractionCategory',
            'attribute' => 'name',
            'inline_create' => true
        ]);

        $this->crud->addField([
            'label' => __('Location'),
            'type' => 'address_google',
            'name' => 'location'
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

    // Setup fetch operation (load attraction categories for select2).
    protected function fetchAttractionCategory()
    {
        return $this->fetch([
            'model' => \App\Models\AttractionCategory::class,
            'searchable_attributes' => ['name']
        ]);
    }
}
