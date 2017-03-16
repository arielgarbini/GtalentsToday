<?php

use Illuminate\Database\Seeder;

class ExperienceRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i=0; $i<2; $i++)
        	factory(Vanguard\ExperienceRole::class, 'es', 1)->create();

    	for($i=0; $i<2; $i++)
        	factory(Vanguard\ExperienceRole::class, 'en', 1)->create();
    }
}
