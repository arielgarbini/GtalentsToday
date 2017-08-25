<?php

use Illuminate\Database\Seeder;
use Vanguard\Vacancy;

class VacanciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vacancy::create([
            'poster_user_id'    => 2,
            'name'              => 'Programador Frontend',
            'description'       => 'Test prueba para descripcion 1',
            'positions_number'  => 2,
            'scheme_work_id'    => 1,
            'responsabilities'  => 'Test de responsabilidades 1',
            'experience'        => 'Experience test 1',
            'key_points'        => 'A B C D',
            'minimum_salary'    => 1000,
            'maximum_salary'    => 1500,
            'career_plan'       => 'A largo plazo',
            'contract_type_id'  => 1,
            'address_id'        => 1,
            'vacancy_status_id' => 1,
            'created_at'        => \Carbon\Carbon::now(),
            'updated_at'        => \Carbon\Carbon::now(),
        ]);

        Vacancy::create([
            'poster_user_id'    => 3,
            'name'              => 'Programador PHP',
            'description'       => 'Test prueba para descripcion 2',
            'positions_number'  => 3,
            'scheme_work_id'    => 2,
            'responsabilities'  => 'Test de responsabilidades 2',
            'experience'        => 'Experience test 2',
            'key_points'        => 'A B C D',
            'minimum_salary'    => 1010,
            'maximum_salary'    => 1500,
            'career_plan'       => 'A tiempo determinado',
            'contract_type_id'  => 1,
            'address_id'        => 1,
            'vacancy_status_id' => 1,
            'created_at'        => \Carbon\Carbon::now(),
            'updated_at'        => \Carbon\Carbon::now(),
        ]);
    }
}
