<?php

namespace App;

use Spatie\Multitenancy\TenantFinder\TenantFinder;
use Spatie\Multitenancy\Models\Concerns\UsesTenantModel;
use Spatie\Multitenancy\Models\Tenant;
use Illuminate\Http\Request;

class TestingTenantFinder extends TenantFinder
{
    use UsesTenantModel;

    public function findForRequest(Request $request): ?Tenant
    {
        return $this->getTenantModel()->where('slug', 'grad-zabok')->first();
    }
}
