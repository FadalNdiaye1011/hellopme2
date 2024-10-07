<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web' ]);
        $editorRole = Role::create(['name' => 'editor', 'guard_name' => 'web' ]);
        $validatorRole = Role::create(['name' => 'validator', 'guard_name' => 'web' ]);

        // Create permissions
        $createOpportunityPermission = Permission::create(['name' => 'validate opportunity']);
        $editOpportunityPermission = Permission::create(['name' => 'edit opportunity']);
        $deleteOpportunityPermission = Permission::create(['name' => 'delete opportunity']);

        // Assign permissions to roles
        $adminRole->givePermissionTo(
            [$createOpportunityPermission, $editOpportunityPermission, $deleteOpportunityPermission]);
        $editorRole->givePermissionTo([$createOpportunityPermission, $editOpportunityPermission]);
        $validatorRole->givePermissionTo(
            [$createOpportunityPermission, $editOpportunityPermission]);
    }
}
