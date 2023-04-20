<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

// Login token model.
// Used for saving tokens for dashboard logins.
class LoginToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'token',
        'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    // Login token belongs to a website (tenant).
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
