<?php

use Illuminate\Database\Seeder;
use Vanguard\ContractType;

class ContractTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 1;

        ContractType::create([
            'value_id'    => $i++,
            'name'        => 'Tiempo completo',
            'language_id' => 1,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        ContractType::create([
            'value_id'    => $i++,
            'name'        => 'Tiempo parcial',
            'language_id' => 1,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        ContractType::create([
            'value_id'    => $i++,
            'name'        => 'Gestión interina',
            'language_id' => 1,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        ContractType::create([
            'value_id'    => $i++,
            'name'        => 'Consultor',
            'language_id' => 1,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        ContractType::create([
            'value_id'    => $i++,
            'name'        => 'Contratista',
            'language_id' => 1,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        $i = 1;

        ContractType::create([
            'value_id'    => $i++,
            'name'        => 'Full-Time',
            'language_id' => 2,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        ContractType::create([
            'value_id'    => $i++,
            'name'        => 'Part-Time',
            'language_id' => 2,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        ContractType::create([
            'value_id'    => $i++,
            'name'        => 'Interim Management',
            'language_id' => 2,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        ContractType::create([
            'value_id'    => $i++,
            'name'        => 'Consultant',
            'language_id' => 2,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        ContractType::create([
            'value_id'    => $i++,
            'name'        => 'Contractor',
            'language_id' => 2,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);
    }
}
