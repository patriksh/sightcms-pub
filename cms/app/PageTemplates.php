<?php

namespace App;

// All the fields for the specific page templates.
trait PageTemplates
{
    private function generic()
    {
        $this->crud->addField([
            'name' => 'content',
            'label' => __('Content'),
            'type' => 'wysiwyg'
        ]);
    }
}