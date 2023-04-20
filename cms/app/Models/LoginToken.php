<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesLandlordConnection;

class LoginToken extends Model
{
    use UsesLandlordConnection;

    protected $fillable = [
        'tenant_id',
        'token',
        'expires_at'
    ];
}
