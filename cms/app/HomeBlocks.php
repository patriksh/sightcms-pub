<?php

namespace App;

use App\Models\ArticleCategory;
use Backpack\CRUD\app\Library\Widget;

// All the fields for the specific home blocks.
trait HomeBlocks
{
    private function hero()
    {
        $this->crud->addField([
            'label' => __('Title'),
            'name' => 'title',
            'type' => 'text',
            'fake' => true,
            'store_in' => 'extras'
        ]);

        $this->crud->addField([
            'label' => __('Text'),
            'name' => 'text',
            'type' => 'text',
            'fake' => true,
            'store_in' => 'extras'
        ]);

        $this->crud->addField([
            'label' => __('Buttons'),
            'name' => 'buttons',
            'type' => 'table',
            'columns' => [
                'text' => 'Text',
                'url' => 'URL',
                'icon' => 'Icon'
            ],
            'max' => 2,
            'fake' => true,
            'store_in' => 'extras'
        ]);

        $this->crud->addField([
            'label' => __('Background image'),
            'name' => 'image',
            'type' => 'upload_with_preview',
            'upload' => true,
            'fake' => true,
            'store_in' => 'extras'
        ]);
    }

    private function features()
    {
        $this->crud->addField([
            'label' => __('Title'),
            'name' => 'title',
            'type' => 'text',
            'fake' => true,
            'store_in' => 'extras'
        ]);
        
        $this->crud->addField([
            'label' => __('Text'),
            'name' => 'text',
            'type' => 'text',
            'fake' => true,
            'store_in' => 'extras'
        ]);

        $this->crud->addField([
            'label' => __('Alignment'),
            'name' => 'align',
            'type' => 'select_from_array',
            'options' => [
                'left' => 'Left',
                'center' => 'Center'
            ],
            'fake' => true,
            'store_in' => 'extras'
        ]);
        
        $this->crud->addField([
            'label' => __('Items'),
            'name' => 'items',
            'type' => 'table',
            'columns' => [
                'title' => 'Title',
                'text' => 'Text',
                'url' => 'URL',
                'icon' => 'Icon',
            ],
            'max' => 6,
            'fake' => true,
            'store_in' => 'extras'
        ]);
    }

    private function text_block()
    {
        $this->crud->addField([
            'label' => __('Title'),
            'name' => 'title',
            'type' => 'text',
            'fake' => true,
            'store_in' => 'extras'
        ]);
        
        $this->crud->addField([
            'label' => __('Text'),
            'name' => 'text',
            'type' => 'wysiwyg',
            'fake' => true,
            'store_in' => 'extras'
        ]);
    }

    private function text_image_block()
    {
        $this->crud->addField([
            'label' => __('Title'),
            'name' => 'title',
            'type' => 'text',
            'fake' => true,
            'store_in' => 'extras'
        ]);
        
        $this->crud->addField([
            'label' => __('Text'),
            'name' => 'text',
            'type' => 'wysiwyg',
            'fake' => true,
            'store_in' => 'extras'
        ]);

        $this->crud->addField([
            'label' => __('Image 1'),
            'name' => 'image_1',
            'type' => 'upload_with_preview',
            'upload' => true,
            'fake' => true,
            'store_in' => 'extras'
        ]);

        $this->crud->addField([
            'label' => __('Image 2'),
            'name' => 'image_2',
            'type' => 'upload_with_preview',
            'upload' => true,
            'fake' => true,
            'store_in' => 'extras'
        ]);
    }

    private function articles()
    {
        $this->crud->addField([
            'label' => __('Title'),
            'name' => 'title',
            'type' => 'text',
            'fake' => true,
            'store_in' => 'extras'
        ]);
        
        $this->crud->addField([
            'label' => __('Subtitle'),
            'name' => 'subtitle',
            'type' => 'text',
            'fake' => true,
            'store_in' => 'extras'
        ]);

        $this->crud->addField([
            'label' => __('Hide latest article'),
            'type' => 'checkbox',
            'name' => 'latest',
            'fake' => true,
            'store_in' => 'extras'
        ]);

        $this->crud->addField([
            'label' => __('Category'),
            'type' => 'select_from_array',
            'name' => 'category_id',
            'options' => ArticleCategory::orderBy('name')->get()->pluck('name', '_id')->all(),
            'fake' => true,
            'store_in' => 'extras'
        ]);
    }

    private function featured_article()
    {
        Widget::add()->type('script')->content('packages/sightcms/admin/home-block-featured-article-toggle.js');

        $this->crud->addField([
            'label' => __('Show latest article'),
            'type' => 'checkbox',
            'name' => 'latest',
            'fake' => true,
            'store_in' => 'extras'
        ]);

        $this->crud->addField([
            'label' => __('Article'),
            'type' => 'select2_from_ajax',
            'name' => 'article_id',
            'model' => 'App\Models\Article',
            'attribute' => 'title',
            'data_source' => url('admin/home-block/fetch/article'),
            'method' => 'POST',
            'fake' => true,
            'store_in' => 'extras'
        ]);
    }
}