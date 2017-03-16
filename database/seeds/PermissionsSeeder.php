<?php

use Illuminate\Database\Seeder;
use Vanguard\Permission;
use Vanguard\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions[] = Permission::create([
            'name'         => 'users.manage',
            'display_name' => 'Manage Users',
            'description'  => 'Manage users and their sessions.',
            'removable'    => false,
        ]);

        $permissions[] = Permission::create([
            'name'         => 'users.activity',
            'display_name' => 'View System Activity Log',
            'description'  => 'View activity log for all system users.',
            'removable'    => false,
        ]);

        $permissions[] = Permission::create([
            'name'         => 'roles.manage',
            'display_name' => 'Manage Roles',
            'description'  => 'Manage system roles.',
            'removable'    => false,
        ]);

        $permissions[] = Permission::create([
            'name'         => 'permissions.manage',
            'display_name' => 'Manage Permissions',
            'description'  => 'Manage role permissions.',
            'removable'    => false,
        ]);

        $permissions[] = Permission::create([
            'name'         => 'candidates.manage',
            'display_name' => 'Manage Candidates',
            'description'  => 'Manage candidates of systems.',
            'removable'    => false,
        ]);

        $permissions[] = Permission::create([
            'name'         => 'categories.manage',
            'display_name' => 'Manage Categories',
            'description'  => 'Manage categories of systems.',
            'removable'    => false,
        ]);

        $permissions[] = Permission::create([
            'name'         => 'companies.manage',
            'display_name' => 'Manage Companies',
            'description'  => 'Manage companies accounts systems.',
            'removable'    => false,
        ]);

        $permissions[] = Permission::create([
            'name'         => 'vacancies.create',
            'display_name' => 'Create vacancies',
            'description'  => 'Create vacancies of systems.',
            'removable'    => false,
        ]);

        $permissions[] = Permission::create([
            'name'         => 'vacancies.view',
            'display_name' => 'View vacancies',
            'description'  => 'View vacancies of systems.',
            'removable'    => false,
        ]);

        $permissions[] = Permission::create([
            'name'         => 'vacancies.edit',
            'display_name' => 'Edit vacancies',
            'description'  => 'Edit vacancies of systems.',
            'removable'    => false,
        ]);

        $permissions[] = Permission::create([
            'name'         => 'vacancies.delete',
            'display_name' => 'Delete vacancies',
            'description'  => 'Delete vacancies of systems.',
            'removable'    => false,
        ]);

        $permissions[] = Permission::create([
            'name'         => 'settings.general',
            'display_name' => 'Update General System Settings',
            'description'  => '',
            'removable'    => false,
        ]);

        $permissions[] = Permission::create([
            'name'         => 'settings.auth',
            'display_name' => 'Update Authentication Settings',
            'description'  => 'Update authentication and registration system settings.',
            'removable'    => false,
        ]);

        $permissions[] = Permission::create([
            'name'         => 'settings.notifications',
            'display_name' => 'Update Notifications Settings',
            'description'  => '',
            'removable'    => false,
        ]);

        $permissions[] = Permission::create([
            'name'         => 'news.manage',
            'display_name' => 'Manage News',
            'description'  => 'Manage news of systems.',
            'removable'    => false,
        ]);
        
        $adminRole = Role::where('name', 'Admin')->first();

        $adminRole->attachPermissions($permissions);
        
        $adminConsultantRole = Role::where('name', 'AdminConsultant')->first();

        $adminConsultantRole->attachPermission($permissions[0]);
        $adminConsultantRole->attachPermission($permissions[4]);
        $adminConsultantRole->attachPermission($permissions[6]);
        $adminConsultantRole->attachPermission($permissions[7]);
        $adminConsultantRole->attachPermission($permissions[8]);
        $adminConsultantRole->attachPermission($permissions[9]);
        $adminConsultantRole->attachPermission($permissions[10]);

        $consultant = Role::where('name', 'Consultant')->first();

        $consultant->attachPermission($permissions[4]);
        $consultant->attachPermission($permissions[7]);
        $consultant->attachPermission($permissions[8]);
        $consultant->attachPermission($permissions[9]);
        $consultant->attachPermission($permissions[10]);

    }
}
