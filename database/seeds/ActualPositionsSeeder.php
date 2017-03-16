<?php

use Illuminate\Database\Seeder;
use Vanguard\ActualPosition;

class ActualPositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 1;

        ActualPosition::create([
            'value_id'    => $i++,
            'name'        => 'Presidente, Fundador, Socio Senior , Gerente, Director General, Senior Client Partner',
            'language_id' => 1,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        ActualPosition::create([
            'value_id'    => $i++,
            'name'        => 'Vicepresidente, Socio, Practice Leader, Regional Practice Leader, Client Partner',
            'language_id' => 1,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        ActualPosition::create([
            'value_id'    => $i++,
            'name'        => 'Director, Principal, Director Asociado, Gerente de Industria',
            'language_id' => 1,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        ActualPosition::create([
            'value_id'    => $i++,
            'name'        => 'Asociado Senior, Consultor Senior, Gerente de Investigación, Gerente de desarrollo de negocio, Ejecutivo de Cuenta, Gerente de Cuenta, Reclutador Senior',
            'language_id' => 1,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        ActualPosition::create([
            'value_id'    => $i++,
            'name'        => 'Consultor, Asociado, Headhunter, Headhunter Independiente, reclutador',
            'language_id' => 1,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        ActualPosition::create([
            'value_id'    => $i++,
            'name'        => 'Sourcer, Investigador, Investigador Asociado, Analista de Investigación',
            'language_id' => 1,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        ActualPosition::create([
            'value_id'    => $i++,
            'name'        => 'Otra',
            'language_id' => 1,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);


        $i = 1;

        ActualPosition::create([
            'value_id'    => $i++,
            'name'        => 'President, Founder, Senior Partner, Country Manager, Managing Director, Senior Client Partner',
            'language_id' => 2,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        ActualPosition::create([
            'value_id'    => $i++,
            'name'        => 'Vice President, Partner, Practice Leader, Regional Practice Leader, Client Partner',
            'language_id' => 2,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        ActualPosition::create([
            'value_id'    => $i++,
            'name'        => 'Director, Principal, Associate Principal, Industry Manager',
            'language_id' => 2,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        ActualPosition::create([
            'value_id'    => $i++,
            'name'        => 'Senior Associate, Senior Consultant, Research Manager, Business Development Manager, Account Executive, Account Manager, Senior Recruiter',
            'language_id' => 2,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        ActualPosition::create([
            'value_id'    => $i++,
            'name'        => 'Consultant, Associate, Headhunter, Independent Headhunter, Recruiter',
            'language_id' => 2,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        ActualPosition::create([
            'value_id'    => $i++,
            'name'        => 'Sourcer, Researcher, Research Associate, Research Analyst',
            'language_id' => 2,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);

        ActualPosition::create([
            'value_id'    => $i++,
            'name'        => 'Other',
            'language_id' => 2,
            'created_at'  => \Carbon\Carbon::now(),
            'updated_at'  => \Carbon\Carbon::now(),
        ]);
    }
}
