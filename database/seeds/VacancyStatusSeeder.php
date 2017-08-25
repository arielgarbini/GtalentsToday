<?php

use Illuminate\Database\Seeder;
use Vanguard\VacancyStatus;

class VacancyStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 1;

        VacancyStatus::create([
            'value_id'    => $i++,
            'name'        => 'Activa',
            'language_id' => 1,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        VacancyStatus::create([
            'value_id'    => $i++,
            'name'        => 'Pendiente',
            'language_id' => 1,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        VacancyStatus::create([
            'value_id'    => $i++,
            'name'        => 'Inactiva',
            'language_id' => 1,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        VacancyStatus::create([
            'value_id'    => $i++,
            'name'        => 'Finalizada',
            'language_id' => 1,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        $i = 1;

        VacancyStatus::create([
            'value_id'    => $i++,
            'name'        => 'Active',
            'language_id' => 2,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        VacancyStatus::create([
            'value_id'    => $i++,
            'name'        => 'Pending',
            'language_id' => 2,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        VacancyStatus::create([
            'value_id'    => $i++,
            'name'        => 'Inactive',
            'language_id' => 2,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        VacancyStatus::create([
            'value_id'    => $i++,
            'name'        => 'Finished',
            'language_id' => 2,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);
    }
}
