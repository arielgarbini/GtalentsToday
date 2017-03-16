<?php

use Illuminate\Database\Seeder;

class ExperienceYearsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 1;

        DB::table('experience_years')->insert([
            [
                'value_id'    => $i++,
                'name'        => 'Menos de 1 año',
                'language_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => '1 a 2 años',
                'language_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => '3 a 5 años',
                'language_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => '6 a 10 años',
                'language_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => '10 a 15 años',
                'language_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'Más de 15 años',
                'language_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
        ]);

        $i = 1;

        DB::table('experience_years')->insert([
            [
                'value_id'    => $i++,
                'name'        => 'Less than 1 year',
                'language_id' => 2,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => '1 to 2 years',
                'language_id' => 2,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => '3 to 5 years',
                'language_id' => 2,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => '6 to 10 years',
                'language_id' => 2,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => '10 to 15 years',
                'language_id' => 2,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'More than 15 years',
                'language_id' => 2,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
