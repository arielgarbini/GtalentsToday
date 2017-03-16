<?php

use Illuminate\Database\Seeder;
use Vanguard\Address;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::create([
            'address_type_id' => 1,
            'address'         => 'Avenida Bolivar',
            'complement'      => null,
            'state_id'        => 3723,
            'zip_code'        => '6201',
            'city'            => 'Maturin',
            'is_active'       => 1,
            'created_at'      => \Carbon\Carbon::now(),
            'updated_at'      => \Carbon\Carbon::now(),
        ]);

        Address::create([
            'address_type_id' => 1,
            'address'         => 'Avenida Bolivar',
            'complement'      => null,
            'state_id'        => 3721,
            'zip_code'        => '5101',
            'city'            => 'Merida',
            'is_active'       => 1,
            'created_at'      => \Carbon\Carbon::now(),
            'updated_at'      => \Carbon\Carbon::now(),
        ]);
    }
}
