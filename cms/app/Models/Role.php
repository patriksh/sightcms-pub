<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Role extends SpatieRole
{
    use CrudTrait;
    use UsesTenantConnection;
}
