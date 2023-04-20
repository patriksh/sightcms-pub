<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Http\Controllers\Admin\Operations\FetchOperation;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

class ArticleCrudController extends CrudController
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
        $this->crud->setModel(\App\Models\Article::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/article');
        $this->crud->setEntityNameStrings(__('article'), __('articles'));
        $this->setupAccessByPermissions();
    }

    // Setup list operation (load columns).
    protected function setupListOperation()
    {
        $this->crud->orderBy('published_at', 'DESC');

        $this->crud->addColumn([
            'label' => __('Title'),
            'name' => 'title'
        ]);

        $this->crud->addColumn([
            'label' => __('Summary'),
            'name' => 'summary'
        ]);

        $this->crud->addColumn([
            'label' => __('Category'),
            'name' => 'article_category.name'
        ]);
        
        $this->crud->addColumn([
            'label' => __('Publish date'),
            'name' => 'published_at',
            'type' => 'datetime'
        ]);

        // Add a button for article categories (they aren't in the sidebar).
        $this->crud->addButtonFromView('top', 'categories', 'categories', 'end');
        
        // Add a button for article preferences (they aren't in the sidebar).
        $this->crud->addButtonFromView('top', 'preferences', 'preferences', 'end');

        // Add a button for viewing the article on frontend.
        $this->crud->addButtonFromView('line', 'view', 'view', 'beginning');
    }

    // Setup create operation (load fields).
    protected function setupCreateOperation()
    {
        $this->crud->setValidation([
            'title' => 'required|min:2',
            'article_category_id' => 'required',
            'content' => 'required|min:2'
        ]);

        $this->crud->addField([
            'label' => __('Title'),
            'type' => 'text',
            'name' => 'title'
        ]);

        $this->crud->addField([
            'label' => __('Category'),
            'type' => 'relationship',
            'name' => 'article_category_id',
            'entity' => 'article_category',
            'model' => 'App\Models\ArticleCategory',
            'attribute' => 'name',
            'inline_create' => true,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'label' => __('Publish date'),
            'type' => 'datetime',
            'name' => 'published_at',
            'default' => date('Y-m-d H:i:s'),
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'label' => __('Summary'),
            'type' => 'text',
            'name' => 'summary'
        ]);

        $this->crud->addField([
            'label' => __('Content'),
            'name' => 'content',
            'type' => 'wysiwyg',
            'attributes' => ['rows' => 30]
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

    // Setup fetch operation (load article categories for select2).
    protected function fetchArticleCategory()
    {
        return $this->fetch([
            'model' => \App\Models\ArticleCategory::class,
            'searchable_attributes' => ['name']
        ]);
    }
}
