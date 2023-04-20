<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Document extends Model
{
    use CrudTrait;
    use Sluggable;
    use UsesTenantConnection;

    protected $fillable = [
        'name',
        'document_category_id',
        'file'
    ];

    // A document belongs to a (document) category.
    public function document_category()
    {
        return $this->belongsTo(DocumentCategory::class);
    }

    // Upload the file when it's set.
    public function setFileAttribute($value)
    {
        $this->uploadFileToDisk($value, 'file', 'public', 'uploads/document');
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
