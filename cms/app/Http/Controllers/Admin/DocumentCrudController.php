<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Operations\FetchOperation;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

class DocumentCrudController extends CrudController
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
        $this->crud->setModel(\App\Models\Document::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/document');
        $this->crud->setEntityNameStrings(__('document'), __('documents'));
        $this->setupAccessByPermissions();

        // Add a button for viewing the document file in the new tab.
        $this->crud->addButtonFromView('line', 'view', 'view_document', 'beginning');
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
            'name' => 'document_category.name'
        ]);

        $this->crud->addColumn([
            'label' => __('File'),
            'name' => 'file',
            'type' => 'file'
        ]);

        // Add a button for document categories (they aren't in the sidebar).
        $this->crud->addButtonFromView('top', 'categories', 'categories', 'end');
        
        // Add a button for document preferences (they aren't in the sidebar).
        $this->crud->addButtonFromView('top', 'preferences', 'preferences', 'end');
    }

    // Setup create operation (load fields).
    protected function setupCreateOperation()
    {
        $this->crud->setValidation([
            'name' => 'required|min:2',
            'document_category_id' => 'required',
            'file' => 'required'
        ]);

        $this->crud->addField([
            'label' => __('Name'),
            'type' => 'text',
            'name' => 'name'
        ]);

        $this->crud->addField([
            'label' => __('Category'),
            'type' => 'relationship',
            'name' => 'document_category_id',
            'entity' => 'document_category',
            'model' => 'App\Models\DocumentCategory',
            'attribute' => 'name',
            'inline_create' => true
        ]);

        $this->crud->addField([
            'label' => __('File'),
            'name' => 'file',
            'type' => 'upload',
            'upload' => true
        ]);
    }

    // Setup update operation (same as create).
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    // Setup fetch operation (load document categories for select2).
    protected function fetchDocumentCategory()
    {
        return $this->fetch([
            'model' => \App\Models\DocumentCategory::class,
            'searchable_attributes' => ['name']
        ]);
    }
}
