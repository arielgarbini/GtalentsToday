<?php

use Illuminate\Database\Seeder;
use Vanguard\VacancyUser;

class VacancyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VacancyUser::create([
            'vacancy_id'       => 1,
            'supplier_user_id' => 3,
            'status'           => 'Unconfirmed',
            'is_active'        => true,
            'created_at'       => \Carbon\Carbon::now(),
            'updated_at'       => \Carbon\Carbon::now(),
        ]);
    }
}
