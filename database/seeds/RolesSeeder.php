<?php

use Illuminate\Database\Seeder;
use Vanguard\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'         => 'Admin',
            'display_name' => 'Admin',
            'description'  => 'System administrator.',
            'removable'    => false,
        ]);

        Role::create([
            'name'         => 'User',
            'display_name' => 'User',
            'description'  => 'Default system user.',
            'removable'    => false,
        ]);

        Role::create([
            'name'         => 'Editor',
            'display_name' => 'Editor',
            'description'  => 'System user with role editor.',
            'removable'    => false,
        ]);

        Role::create([
            'name'         => 'AdminConsultant',
            'display_name' => 'AdminConsultant',
            'description'  => 'Consultant administrator.',
            'removable'    => false,
        ]);

        Role::create([
            'name'         => 'Consultant',
            'display_name' => 'Consultant',
            'description'  => 'Consultant.',
            'removable'    => false,
        ]);

        Role::create([
            'name'         => 'ConsultantUnverified',
            'display_name' => 'Consultant Unverified',
            'description'  => 'Consultant Unverified.',
            'removable'    => false,
        ]);
    }
}
