<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Attraction extends Model
{
    use CrudTrait;
    use Sluggable;
    use UsesTenantConnection;

    protected $fillable = [
        'name',
        'attraction_category_id',
        'location',
        'content',
        'image',
        'website_link'
    ];

    // Attraction belongs to a (attraction) category.
    public function attraction_category()
    {
        return $this->belongsTo(AttractionCategory::class);
    }

    // Upload the image when it's set.
    public function setImageAttribute($value)
    {
        $this->uploadFileToDisk($value, 'image', 'public', 'uploads/attractions');
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
