<?php

use Illuminate\Database\Seeder;
use Vanguard\ReplacementPeriod;

class ReplacementPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 1;

        ReplacementPeriod::create([
            'value_id'    => $i++,
            'name'        => '1 mes',
            'language_id' => 1,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        ReplacementPeriod::create([
            'value_id'    => $i++,
            'name'        => '2 meses',
            'language_id' => 1,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        $i = 1;

        ReplacementPeriod::create([
            'value_id'    => $i++,
            'name'        => '1 month',
            'language_id' => 2,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        ReplacementPeriod::create([
            'value_id'    => $i++,
            'name'        => '2 months',
            'language_id' => 2,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);
    }
}
