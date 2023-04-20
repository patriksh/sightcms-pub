<?php

namespace App\Providers;

use App\Models\Preference;
use App\TenantMigrator;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // TODO: See can those this use bind instead of alias.
        $loader = AliasLoader::getInstance();
        $loader->alias('Backpack\CRUD\app\Library\CrudPanel\Traits\Reorder', '\App\Reorder');

        // Override the default Backpack UserCrudController.
        $this->app->bind(\Backpack\PermissionManager\app\Http\Controllers\UserCrudController::class, \App\Http\Controllers\Admin\UserCrudController::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        TenantMigrator::migrate();

        // TODO: Extract to a function or something.
        // Set all preferences as config values.
        if(Cache::has('preferences')) {
            $preferences = cache('preferences');
        } else {
            $preferences = Preference::all();
            Cache::put('preferences', $preferences, 60); // TODO: Figure best cache time.
        };

        foreach($preferences as $preference) {
            Config::set('preferences.' . $preference->section . '.' . $preference->key, $preference->value);
        }
    }
}
