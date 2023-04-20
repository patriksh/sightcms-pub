<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
use Illuminate\Support\Str;

class Preference extends Model
{
    use CrudTrait;
    use UsesTenantConnection;

    protected $fillable = [
        'section',
        'key',
        'value'
    ];

    // TODO: Document better, and probably move this to the CRUD controller?
    public function setValueAttribute($value)
    {
        $this->attributes['value'] = $value;

        $fieldName = $this->attributes['key'];

        // TODO: Figure a better way for identifying file fields.
        if(Str::contains($fieldName, 'file')) {
            // If a file was previously uploaded, set it's filename to an attribute which will be detected by uploadFileToDisk, so the file can be deleted if needed.
            if(isset($this->attributes['value'])) {
                $this->attributes[$fieldName] = $this->attributes['value'];
            }

            $this->uploadFileToDisk($value, $fieldName, 'public', 'uploads/general');

            // If the upload was successful, get the filename from the attribute set by uploadFileToDisk, apply it to the value attribute, and unset the original attribute.
            if(isset($this->attributes[$fieldName])) {
                $this->attributes['value'] = $this->attributes[$fieldName];
                unset($this->attributes[$fieldName]);
            }
        }
    }
}
