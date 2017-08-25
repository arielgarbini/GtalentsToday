<?php

use Illuminate\Database\Seeder;

class QuantityEmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 1;

        DB::table('quantity_employees')->insert([
            [
                'value_id'    => $i++,
                'name'        => '1 a 10',
                'language_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => '11 a 50',
                'language_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'mas de 50',
                'language_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ]
        ]);

        $i = 1;

        DB::table('quantity_employees')->insert([
            [
                'value_id'    => $i++,
                'name'        => '1 to 10',
                'language_id' => 2,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => '11 to 50',
                'language_id' => 2,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'More than 50',
                'language_id' => 2,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
