<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class BikeRoute extends Model
{
    use CrudTrait;
    use Sluggable;
    use UsesTenantConnection;

    protected $fillable = [
        'title',
        'location',
        'content',
        'image'
    ];
    
    // Upload the image when it's set.
    public function setImageAttribute($value)
    {
        $this->uploadFileToDisk($value, 'image', 'public', 'uploads/audio-tours');
    }

    // Automatically generate a slug from the title attribute.
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
