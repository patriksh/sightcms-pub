<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use CrudTrait;
    use HasRoles;
    use UsesTenantConnection;

    protected $fillable = [
        'name',
        'email',
        'password',
        'owner'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    // A user can have many articles.
    public function articles()
    {
        return $this->hasMany(\App\Models\Article::class);
    }

    // A user can belong to many roles.
    // Reimplementation of Spatie\Permission\Traits\HasRoles::roles() to work with MongoDB.
    public function roles()
    {
        return $this->belongsToMany(
            config('permission.models.role'),
            null,
            'user_ids',
            'role_ids'
        );
    }

    // A user can belong to many permissions.
    // Reimplementation of Spatie\Permission\Traits\HasRoles::permissions() to work with MongoDB.
    public function permissions()
    {
        return $this->belongsToMany(
            config('permission.models.permission'),
            null,
            'user_ids',
            'permission_ids'
        );
    }
}
