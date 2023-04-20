<?php

namespace App\Http\Controllers\Admin;

use App\HomeBlocks;
use App\Http\Controllers\Admin\Operations\FetchOperation;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;
use Illuminate\Support\Str;

class HomeBlockCrudController extends CrudController
{
    use HomeBlocks;
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ReorderOperation;
    use FetchOperation;
    use PermissionCheckTrait;

    // Basic CRUD settings.
    public function setup()
    {
        $this->crud->setModel(\App\Models\HomeBlock::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/home-block');
        $this->crud->setEntityNameStrings(__('home block'), __('home blocks'));
        $this->setupAccessByPermissions();
    }

    // Setup list operaton (load columns).
    protected function setupListOperation()
    {
        $this->crud->orderBy('lft', 'DESC');

        $this->crud->addColumn([
            'label' => __('Name'),
            'name' => 'name'
        ]);

        $this->crud->addColumn([
            'label' => __('Block'),
            'name' => 'block'
        ]);
    }

    // Setup create operation (load fields).
    protected function setupCreateOperation()
    {
        $this->addDefaultPageFields(\Request::input('block'));
        $this->useBlock(\Request::input('block'));
    }

    // Setup update operation (same as create).
    protected function setupUpdateOperation()
    {
        $block = \Request::input('block') ?? $this->crud->getCurrentEntry()->block;
        $this->addDefaultPageFields($block);
        $this->useBlock($block);
    }

    // Setup reorder operation. Do not allow nesting.
    protected function setupReorderOperation()
    {
        $this->crud->set('reorder.label', 'name');
        $this->crud->set('reorder.max_level', 1);
    }

    // Setup default fields for all pages.
    protected function addDefaultPageFields($block = false)
    {
        $this->crud->addField([
            'label' => __('Name'),
            'name' => 'name',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'label' => __('Block'),
            'name' => 'block',
            'type' => 'select_home_block',
            'options' => $this->getBlocksArray(),
            'value' => $block,
            'allows_null' => false,
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);
    }

    // Setup page template fields by calling the appropriate method in the HomeBlocks trait.
    protected function useBlock($blockName = false)
    {
        $blocks = $this->getBlocks();

        $blockName = $blockName ?: $blocks[0]->name;

        if($blockName) {
            $this->{$blockName}();
        }
    }

    // Check if the HomeBlocks trait has any methods.
    protected function getBlocks()
    {
        $blocksTrait = new \ReflectionClass('App\HomeBlocks');
        $blocks = $blocksTrait->getMethods(\ReflectionMethod::IS_PRIVATE);

        if(!count($blocks)) {
            abort(503, 'Block not found.');
        }

        return $blocks;
    }

    // Get a list of formatted block names for the select field.
    protected function getBlocksArray()
    {
        $blocks = $this->getBlocks();

        foreach($blocks as $block) {
            $blocksArray[$block->name] = str_replace('_', ' ', Str::title($block->name));
        }

        return $blocksArray;
    }

    // Setup fetch operation (load article categories for select2, used on some blocks).
    protected function fetchArticle()
    {
        return $this->fetch([
            'model' => \App\Models\Article::class,
            'searchable_attributes' => ['title']
        ]);
    }
}
