<?php

use Illuminate\Database\Seeder;
use Vanguard\Condition;

class ConditionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Condition::create([
            'vacancy_id'                => 1,
            'general_condition'         => 'Condiciones generales test 1',
            'approximate_total_billing' => 1250,
            'comission'                 => 20,
            'warranty'                  => 18,
            'created_at'                => \Carbon\Carbon::now(),
            'updated_at'                => \Carbon\Carbon::now(),
        ]);

        Condition::create([
            'vacancy_id'                => 2,
            'general_condition'         => 'Condiciones generales test 2',
            'approximate_total_billing' => 1250,
            'comission'                 => 20,
            'warranty'                  => 18,
            'created_at'                => \Carbon\Carbon::now(),
            'updated_at'                => \Carbon\Carbon::now(),
        ]);
    }
}
