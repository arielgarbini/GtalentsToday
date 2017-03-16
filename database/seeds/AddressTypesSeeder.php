<?php

use Illuminate\Database\Seeder;
use Vanguard\AddressType;

class AddressTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 1;

        AddressType::create([
            'value_id'    => $i++,
            'name'        => 'Tipo 1',
            'language_id' => 1,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        AddressType::create([
            'value_id'    => $i++,
            'name'        => 'Tipo 2',
            'language_id' => 1,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        $i = 1;

        AddressType::create([
            'value_id'    => $i++,
            'name'        => 'Type 1',
            'language_id' => 2,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        AddressType::create([
            'value_id'    => $i++,
            'name'        => 'Type 2',
            'language_id' => 2,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);
    }
}
