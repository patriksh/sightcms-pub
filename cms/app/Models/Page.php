<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
use Illuminate\Support\Str;

class Page extends Model
{
    use CrudTrait;
    use Sluggable;
    use SluggableScopeHelpers;
    use UsesTenantConnection;

    protected $fillable = [
        'template',
        'name',
        'title',
        'slug',
        'content',
        'extras',
        'show_in_app'
    ];

    // Fake column for storing data from the page-specific fields.
    protected $fakeColumns = [
        'extras'
    ];
    
    protected $casts = [
        'extras' => 'array',
    ];

    public function getTemplateName()
    {
        return str_replace('_', ' ', Str::title($this->template));
    }

    public function getPageLink()
    {
        return url($this->slug);
    }

    // Default Backpack open button implementation.
    // TODO: Move into a blade view.
    public function getOpenButton()
    {
        return '<a class="btn btn-sm btn-link" href="' . $this->getPageLink() . '" target="_blank">'.
            '<i class="la la-eye"></i> ' . trans('backpack::pagemanager.open') . '</a>';
    }

    // Automatically generate a slug from the title attribute.
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
}
