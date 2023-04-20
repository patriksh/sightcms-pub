<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Backpack\PermissionManager\app\Models\Role;
use Backpack\PermissionManager\app\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    protected $roles = [
        [
            'name' => 'admin',
            'permissions' => [
                '*'
            ]
        ],
        [
            'name' => 'content manager',
            'permissions' => [
                'static_pages',
                'articles',
                'article_categories',
                'documents',
                'document_categories',
                'events',
                'attractions',
                'attraction_categories',
                'gastronomy',
                'gastronomy_categories',
                'bike_routes',
                'audio_tours'
            ]
        ],
        [
            'name' => 'writer',
            'permissions' => [
                'articles',
                'article_categories'
            ]
        ]
    ];

    // Insert default roles & permissions.
    public function run()
    {
        foreach($this->roles as $role) {
            $roleModel = Role::create(['name' => $role['name']]);

            foreach($role['permissions'] as $permission) {
                $permissionModel = Permission::firstOrCreate(['name' => $permission]);
                $permissionModel->assignRole($roleModel);
            }
        }
    }
}
