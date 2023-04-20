<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Event extends Model
{
    use CrudTrait;
    use Sluggable;
    use UsesTenantConnection;

    protected $fillable = [
        'title',
        'content',
        'date_from',
        'date_to',
        'location',
        'website_link',
        'logo',
        'image'
    ];

    // TODO: Uploads can be handled directly in CRUD controllers.
    // https://backpackforlaravel.com/docs/5.x/release-notes#define-model-events-directly-on-fields

    // Upload the logo image when it's set.
    public function setLogoAttribute($value)
    {
        $this->uploadFileToDisk($value, 'logo', 'public', 'uploads/events');
    }

    // Upload the image when it's set.
    public function setImageAttribute($value)
    {
        $this->uploadFileToDisk($value, 'image', 'public', 'uploads/events');
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
