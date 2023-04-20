<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

// Tenant (website) model.
// On cms, it extens the spatie/laravel-multitenancy Tenant model,
// here it's just a regular MongoDB model with added on fields
// (slug, user_id, type, plan, migrated).

class Tenant extends Model
{
    use HasFactory;
    use Sluggable;
    use SluggableScopeHelpers; // TODO: Add this trait to other models (in cms).

    protected $fillable = [
        'slug',
        'user_id',
        'name',
        'database',
        'domain',
        'type',
        'plan', // TODO: plan_id
        'migrated'
    ];

    // Website (tenant) belongs to a user.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Website (tenant) can have many login tokens.
    public function loginTokens()
    {
        return $this->hasMany(LoginToken::class);
    }

    // Automatically generates a slug from the name attribute.
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
