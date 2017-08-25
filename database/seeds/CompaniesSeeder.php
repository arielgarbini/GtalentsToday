<?php

use Illuminate\Database\Seeder;
use Vanguard\Company;
use Vanguard\Experience;
use Vanguard\Profile;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = Company::create([
            'name'                  => 'Consultores y Asociados',
            'comercial_name'        => 'Consultores y Asociados SA',
            'register_number'       => 123,
            'address_id'            => 2,
            'quantity_employees_id' => 1,
            'is_active'             => 1,
            'created_at'            => \Carbon\Carbon::now(),
            'updated_at'            => \Carbon\Carbon::now(),
        ]);

        $experience = Experience::create(['company_id' => $company->id]);
        $profile    = Profile::create(['company_id' => $company->id]);

    }
}
