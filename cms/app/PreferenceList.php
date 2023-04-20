<?php

namespace App;

// List of all the preferences, used for the CRUD fields and for the seeder.
class PreferenceList
{
    public static function get() {
        return [
            'identity' => [
                [
                    'name' => 'name',
                    'label' => __('Site name'),
                    'type' => 'text',
                    'validationRules' => 'required'
                ],
                [
                    'name' => 'description',
                    'label' => __('Site description'),
                    'type' => 'text',
                    'validationRules' => 'required'
                ],
                [
                    'name' => 'logo_file',
                    'label' => __('Site logo'),
                    'type' => 'upload_with_preview',
                    'upload' => true,
                    'attributes' => [
                        'accept' => 'image/*'
                    ],
                    'validationRules' => 'nullable|image',
                    'wrapperAttributes' => [
                        'class' => 'form-group col-md-6'
                    ]
                ],
                [
                    'name' => 'icon_file',
                    'label' => __('Site icon'),
                    'type' => 'upload_with_preview',
                    'upload' => true,
                    'attributes' => [
                        'accept' => 'image/*'
                    ],
                    'validationRules' => 'nullable|image',
                    'wrapperAttributes' => [
                        'class' => 'form-group col-md-6'
                    ]
                ],
                [
                    'name' => 'accent_color',
                    'label' => __('Accent color'),
                    'type' => 'color',
                    'default' => '#22b573',
                    'validationRules' => 'required'
                ]
            ],
            'footer' => [
                [
                    'name' => 'copyright',
                    'label' => __('Copyright text'),
                    'type' => 'text',
                    'default' => 'Copyright © {year}. All rights reserved.',
                    'validationRules' => 'required'
                ],
                [
                    'label' => __('Social links'),
                    'name' => 'socials',
                    'type' => 'table',
                    'columns' => [
                        'network' => 'Network',
                        'url' => 'URL'
                    ]
                ]
            ],
            'article' => [
                [
                    'name' => 'per_page',
                    'label' => __('Articles per page'),
                    'type' => 'number',
                    'default' => 12,
                    'validationRules' => 'required|numeric|min:1'
                ]
            ],
            'document' => [
                [
                    'name' => 'per_page',
                    'label' => __('Documents per page'),
                    'type' => 'number',
                    'default' => 50,
                    'validationRules' => 'required|numeric|min:1'
                ]
            ],
            'attraction' => [
                [
                    'name' => 'per_page',
                    'label' => __('Attractions per page'),
                    'type' => 'number',
                    'default' => 12,
                    'validationRules' => 'required|numeric|min:1'
                ]
            ],
            'gastro' => [
                [
                    'name' => 'per_page',
                    'label' => __('Gastro per page'),
                    'type' => 'number',
                    'default' => 12,
                    'validationRules' => 'required|numeric|min:1'
                ]
            ],
            'contact' => [
                [
                    'name' => 'email',
                    'label' => __('Contact form email'),
                    'type' => 'email',
                    'validationRules' => 'required|email'
                ],
                [
                    'name' => 'subtitle',
                    'label' => __('Contact form subtitle'),
                    'type' => 'text',
                ],
                // TODO: Make a custom field type for this, still CSV, but with a tag-like UI.
                // TODO: Or another consideration, a proper CRUD for contact categories that allows you to define exact emails for each category.
                [
                    'name' => 'categories',
                    'label' => __('Contact form categories (separate with a comma)'),
                    'type' => 'text',
                ],
                [
                    'name' => 'info',
                    'label' => __('Extra contact information'),
                    'type' => 'wysiwyg',
                ],
            ],
            'seo' => [
                [
                    'name' => 'title',
                    'label' => __('Meta title'),
                    'hint' => __('Use <i>{CURRENT_PAGE}</i> to insert the current page title and <i>{SITE_NAME}</i> to insert the site name.'),
                    'type' => 'text',
                    'default' => '{CURRENT_PAGE} - {SITE_NAME}',
                    'validationRules' => 'required'
                ],
                [
                    'name' => 'description',
                    'label' => __('Meta description'),
                    'hint' => __('Use <i>{CURRENT_PAGE}</i> to insert the current page title, <i>{SITE_NAME}</i> to insert the site name, and <i>{SITE_DESCRIPTION}</i> to insert the site description.'),
                    'type' => 'text',
                    'default' => '{SITE_DESCRIPTION}',
                    'validationRules' => 'required'
                ],
                [
                    'name' => 'image_file',
                    'label' => __('Image'),
                    'hint' => __('This image will be used when sharing the site on social media.<br>If no image is specified, the site logo will be used instead.'),
                    'type' => 'upload_with_preview',
                    'upload' => true,
                    'attributes' => [
                        'accept' => 'image/*'
                    ],
                    'validationRules' => 'nullable|image'
                ]
            ],
            'analytics' => [
                [
                    'name' => 'google_analytics',
                    'label' => __('Google Analytics tracking ID'),
                    'type' => 'text',
                    'attributes' => [
                        'placeholder' => 'G-XXXXXXXXXX or AW-XXXXXXXXXX',
                    ],
                ]
            ]
        ];
    }
}