<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class AttractionCategory extends Model
{
    use CrudTrait;
    use Sluggable;
    use UsesTenantConnection;
    
    protected $fillable = [
        'name',
        'icon',
        'parent_id',
        'lft',
        'rgt',
        'depth'
    ];

    // Default values for reorder attributes.
    protected $attributes = [
        'parent_id' => 0,
        'lft' => 0,
        'rgt' => 0,
        'depth' => 0
    ];

    // An atraction category can have many attractions.
    public function attractions()
    {
        return $this->hasMany(Attraction::class);
    }

    // Automatically generate a slug from the name attribute.
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
