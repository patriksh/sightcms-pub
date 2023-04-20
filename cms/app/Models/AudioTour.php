<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
use Owenoj\LaravelGetId3\GetId3;

class AudioTour extends Model
{
    use CrudTrait;
    use Sluggable;
    use UsesTenantConnection;

    protected $fillable = [
        'title',
        'file',
        'content',
        'duration',
        'image'
    ];

    // Upload the file when it's set.
    public function setFileAttribute($value)
    {
        $this->uploadFileToDisk($value, 'file', 'public', 'uploads/audio-tours');

        // Save the duration of the audio file.
        $file = GetId3::fromUploadedFile(request()->file('file'));
        $info = $file->extractInfo();
        $this->attributes['duration'] = $info['playtime_string'];
    }

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
