<?php

use Illuminate\Database\Seeder;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 1;

        DB::table('contacts')->insert([
            [
                'value_id'    => $i++,
                'name'        => 'Uno',
                'language_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'Dos',
                'language_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'Tres',
                'language_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ]
        ]);

        $i = 1;

        DB::table('contacts')->insert([
            [
                'value_id'    => $i++,
                'name'        => 'One',
                'language_id' => 2,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'Two',
                'language_id' => 2,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
            [
                'value_id'    => $i++,
                'name'        => 'Three',
                'language_id' => 2,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
