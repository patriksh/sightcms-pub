<?php

namespace App;

use App\Models\User;
use App\Models\Preference;
use Illuminate\Support\Facades\Artisan;

// Class for instantiating the default website (tenant) data. 
class TenantMigrator
{
    // This method is called on every request in the AppServiceProvider.php, but only runs once per tenant.
    // The idea is that it will run when the user will create the website and visit their dashboard.
    // Another plan was to run the seeders from the landlord package, but that would require a lot of code duplication (preferences, menu items, roles).
    public static function migrate()
    {
        // Don't run on console commands.
        if(app()->runningInConsole()) return;

        $tenant = app('currentTenant');

        if(!$tenant) return;
        if($tenant->migrated) return;

        self::migrateTenant($tenant);
    }

    public static function migrateTenant($tenant)
    {
        // Insert default preferences.
        self::seedClass('PreferencesSeeder');

        // Set page title from tenant name.
        Preference::where('key', 'title')->update(['value' => $tenant->name]);

        // Insert default roles & permissions.
        self::seedClass('RolePermissionSeeder');

        // Create default admin user.
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@' . $tenant->domain,
            'owner' => true
        ]);
        $adminUser->assignRole('admin');

        // Insert default menus depending on tenant type.
        if($tenant->type == 'government') { // TODO: ENUM
            self::seedClass('MenuGovernmentSeeder');
        } else if($tenant->type == 'tourism') {
            self::seedClass('MenuTourismSeeder');
        } else {
            self::seedClass('MenuAllSeeder');
        }

        // Insert default home blocks.
        self::seedClass('HomeBlockSeeder');

        // Insert default pages.
        self::seedClass('PageSeeder');

        // Insert default article.
        self::seedClass('ArticleSeeder');

        $tenant->migrated = true;
        $tenant->save();
    }

    // Calls the artisan db:seed command with the appopriate database connection.
    private static function seedClass($class)
    {
        return Artisan::call('db:seed', [
            '--database' => 'tenant',
            '--force' => true,
            '--class' => $class
        ]);
    }
}
