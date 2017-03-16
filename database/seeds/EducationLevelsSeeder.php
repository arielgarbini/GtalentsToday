<?php

use Illuminate\Database\Seeder;

class EducationLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 1;

        DB::table('education_levels')->insert([
            [
                'value_id'    => $i++,
                'name'        => 'Bachiller',
                'language_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'TSU',
                'language_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'Universitario',
                'language_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ]
        ]);

        $i = 1;

        DB::table('education_levels')->insert([
            [
                'value_id'    => $i++,
                'name'        => 'Bachelor',
                'language_id' => 2,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'Technical',
                'language_id' => 2,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'University',
                'language_id' => 2,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
