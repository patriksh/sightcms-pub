<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Permission extends SpatiePermission
{
    use CrudTrait;
    use UsesTenantConnection;
}
