<?php

use Illuminate\Database\Seeder;
use Vanguard\SchemeWork;

class SchemeWorksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 1;

        SchemeWork::create([
            'value_id'    => $i++,
            'name'        => 'En Oficina',
            'language_id' => 1,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        SchemeWork::create([
            'value_id'    => $i++,
            'name'        => 'Remoto',
            'language_id' => 1,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        SchemeWork::create([
            'value_id'    => $i++,
            'name'        => 'Otro',
            'language_id' => 1,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        $i = 1;

        SchemeWork::create([
            'value_id'    => $i++,
            'name'        => 'In Office',
            'language_id' => 2,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        SchemeWork::create([
            'value_id'    => $i++,
            'name'        => 'Remote',
            'language_id' => 2,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        SchemeWork::create([
            'value_id'    => $i++,
            'name'        => 'Other',
            'language_id' => 2,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);
    }
}
