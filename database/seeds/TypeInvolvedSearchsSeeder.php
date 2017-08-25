<?php

use Illuminate\Database\Seeder;

class TypeInvolvedSearchsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i=0; $i<2; $i++)
        	factory(Vanguard\TypeInvolvedSearch::class, 'es', 1)->create();

    	for($i=0; $i<2; $i++)
        	factory(Vanguard\TypeInvolvedSearch::class, 'en', 1)->create();
    }
}
