<?php

use Illuminate\Database\Seeder;

class LevelPositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 1;

        DB::table('level_positions')->insert([
            [
                'value_id'    => $i++,
                'name'        => 'EXPERIMENTADO',
                'language_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'GERENCIAL',
                'language_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'ENTRY',
                'language_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'PROPIETARIO',
                'language_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'CXO',
                'language_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'VP',
                'language_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'SOCIO',
                'language_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'TRAINING',
                'language_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'JUNIOR',
                'language_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
        ]);

        $i = 1;
        
        DB::table('level_positions')->insert([
            [
                'value_id'    => $i++,
                'name'        => 'SENIOR',
                'language_id' => 2,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'MANAGER',
                'language_id' => 2,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'ENTRY',
                'language_id' => 2,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'OWNER',
                'language_id' => 2,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'CXO',
                'language_id' => 2,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'VP',
                'language_id' => 2,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'PARTNER',
                'language_id' => 2,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'TRAINING',
                'language_id' => 2,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'JUNIOR',
                'language_id' => 2,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
