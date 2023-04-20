<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\Admin\Operations\PreferenceOperation;

class PreferenceCrudController extends CrudController
{
    use PreferenceOperation;

    // Basic CRUD settings.
    public function setup()
    {
        $this->crud->setModel('App\Models\Preference');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/preference');
        $this->crud->setEntityNameStrings(__('preference'), __('preferences'));
        $this->crud->setupDefaultSaveActions();
    }
}
