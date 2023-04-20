<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Gastro extends Model
{
    use CrudTrait;
    use Sluggable;
    use UsesTenantConnection;

    protected $fillable = [
        'name',
        'gastro_category_id',
        'location',
        'content',
        'image',
        'website_link'
    ];

    // A gastro belongs to a (gastro) category.
    public function gastro_category()
    {
        return $this->belongsTo(GastroCategory::class);
    }

    // Upload the image when it's set.
    public function setImageAttribute($value)
    {
        $this->uploadFileToDisk($value, 'image', 'public', 'uploads/gastro');
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
