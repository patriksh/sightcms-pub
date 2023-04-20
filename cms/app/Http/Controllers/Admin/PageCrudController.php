<?php

namespace App\Http\Controllers\Admin;

use Backpack\PageManager\app\Http\Controllers\Admin\PageCrudController as CrudController;

// Extended Backpack PageCrudController to remove slug field input.
class PageCrudController extends CrudController
{
    use PermissionCheckTrait;

    // Basic CRUD settings.
    public function setup()
    {
        parent::setup();
        $this->setupAccessByPermissions();
    }

    // Setup create operation (load fields).
    protected function setupCreateOperation()
    {
        parent::setupCreateOperation();
        $this->addShowInAppField();
        $this->crud->removeField('slug');
    }

    // Setup update operation (same as create).
    protected function setupUpdateOperation()
    {
        parent::setupUpdateOperation();
        $this->addShowInAppField();
        $this->crud->removeField('slug');
    }

    protected function addShowInAppField() {
        $this->crud->addField([
            'name' => 'show_in_app',
            'label' => __('Show in app'),
            'type' => 'checkbox',
            'default' => false
        ]);
    }
}
