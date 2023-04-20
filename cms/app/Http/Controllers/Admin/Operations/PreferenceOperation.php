<?php

namespace App\Http\Controllers\Admin\Operations;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use App\PreferenceList;

// Custom operation type for Backpack, for Preference pages.
// Worked for me better than their Settings plugin,.
trait PreferenceOperation
{
    private $preferenceSection;
    
    // Setup routes for the operation.
    protected function setupPreferencesRoutes($segment, $routeName, $controller)
    {
        Route::get($segment . '/{section}', [
            'as' => $routeName . '.edit',
            'uses' => $controller . '@edit',
            'operation' => 'preferences',
        ]);

        Route::put($segment . '/{section}/update', [
            'as' => $routeName . '.update',
            'uses' => $controller . '@update',
            'operation' => 'preferences',
        ]);
    }

    // Setup default settings and actions.
    protected function setupPreferencesDefaults()
    {
        $this->crud->allowAccess('preferences');

        $this->crud->operation('preferences', function() {
            $this->crud->loadDefaultOperationSettingsFromConfig();

            // Custom save button action, to return you back to the same preferences page.
            $this->crud->replaceSaveActions([
                [
                    'name' => 'save_and_back',
                    'visible' => function ($crud) {
                        return $crud->hasAccess('preferences');
                    },
                    'redirect' => function ($crud, $request, $itemId = null) {
                        return $crud->route . '/' . $this->preferenceSection;
                    },
                    'button_text' => trans('backpack::crud.save_action_save_and_back'),
                ]
            ]);
        });
    }

    // Setup the preferences form.
    public function edit($section)
    {
        $this->crud->hasAccessOrFail('preferences');

        // Check for valid preference section.
        $this->validSectionOrFail($section);

        // Load the preference section fields.
        $this->setSectionFields();

        // Setup the text for titles.
        $this->crud->setEntityNameStrings(__('preference'), __('identity'));

        $this->data['preferenceSection'] = $section;
        $this->data['crud'] = $this->crud;
        $this->data['saveAction'] = $this->crud->getSaveAction();
        $this->data['title'] = ucfirst($section) . ' preferences';

        return view('vendor.backpack.base.preferences', $this->data);
    }

    // Save the preferences.
    public function update($section)
    {
        $this->crud->hasAccessOrFail('preferences');

        // check for valid preference section
        $this->validSectionOrFail($section);

        // Load the preference section fields (for validation).
        $this->setSectionFields();

        // Validate the fields.
        $request = $this->crud->validateRequest();

        // Register any Model Events defined on fields (unused at the moment).
        $this->crud->registerFieldEvents();

        // Save each preference.
        foreach($this->crud->getStrippedSaveRequest($request) as $key => $value) {
            $this->crud->model->updateOrCreate(
                [
                    'section' => $this->preferenceSection,
                    'key' => $key,
                ],
                [
                    'value' => $value
                ]
            );
        }

        // Clear the preferences cache.
        Cache::forget('preferences');

        // Show a success message
        \Alert::success(trans('backpack::crud.update_success'))->flash();

        // Save the redirect choice for next time? Not sure if required.
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction();
    }

    // Make sure the section is valid by checking do settings for it exist in PreferenceList.
    private function validSectionOrFail($section)
    {
        $preferences = PreferenceList::get();

        if(!isset($preferences[$section])) {
            \Alert::error('Invalid preference section')->flash();
            return abort(404);
        }

        $this->preferenceSection = $section;
    }

    // Load the fields for the current preference section.
    // Get the values from the database if needed.
    private function setSectionFields($withValue = true) 
    {
        $preferences = PreferenceList::get()[$this->preferenceSection];

        foreach($preferences as $preference) {
            if($withValue) {
                $preference['value'] = $this->crud->model->where([
                    'section' => $this->preferenceSection,
                    'key' => $preference['name']
                ])->first()->value ?? null;
            }

            $this->crud->addField($preference);
        }
    }
}
