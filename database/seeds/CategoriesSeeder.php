<?php

use Illuminate\Database\Seeder;
use Vanguard\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'                     => 'Newbie',
            'code'                     => 'level-1',
            'avatar'                   => 'level-1.png',
            'required_points'          => 0,
            'poster_percent'           => 40,
            'supplier_percent'         => 40,
            'gtalents_percent'         => 20,
            'is_active'                => true,
            'language_id'              => 2,
            'created_at'               => \Carbon\Carbon::now(),
            'updated_at'               => \Carbon\Carbon::now(),
        ]);

        Category::create([
            'name'                     => 'NHiring Pro',
            'code'                     => 'level-2',
            'avatar'                   => 'level-2.png',
            'required_points'          => 250,
            'poster_percent'           => 42,
            'supplier_percent'         => 41,
            'gtalents_percent'         => 17,
            'is_active'                => true,
            'language_id'              => 2,
            'created_at'               => \Carbon\Carbon::now(),
            'updated_at'               => \Carbon\Carbon::now(),
        ]);
        
        Category::create([
            'name'                     => 'Boolean Boss',
            'code'                     => 'level-3',
            'avatar'                   => 'level-3.png',
            'required_points'          => 750,
            'poster_percent'           => 44,
            'supplier_percent'         => 42,
            'gtalents_percent'         => 14,
            'is_active'                => true,
            'language_id'              => 2,
            'created_at'               => \Carbon\Carbon::now(),
            'updated_at'               => \Carbon\Carbon::now(),
        ]);
        
        Category::create([
            'name'                     => 'Staffing Elite',
            'code'                     => 'level-4',
            'avatar'                   => 'level-4.png',
            'required_points'          => 2000,
            'poster_percent'           => 46,
            'supplier_percent'         => 43,
            'gtalents_percent'         => 11,
            'is_active'                => true,
            'language_id'              => 2,
            'created_at'               => \Carbon\Carbon::now(),
            'updated_at'               => \Carbon\Carbon::now(),
        ]);
        
        Category::create([
            'name'                     => 'Sourcing Guru',
            'code'                     => 'level-5',
            'avatar'                   => 'level-5.png',
            'required_points'          => 5000,
            'poster_percent'           => 48,
            'supplier_percent'         => 44,
            'gtalents_percent'         => 8,
            'is_active'                => true,
            'language_id'              => 2,
            'created_at'               => \Carbon\Carbon::now(),
            'updated_at'               => \Carbon\Carbon::now(),
        ]);
        
        Category::create([
            'name'                     => 'Global Talent Shift Icon',
            'code'                     => 'level-6',
            'avatar'                   => 'level-6.png',
            'required_points'          => 10000,
            'poster_percent'           => 50,
            'supplier_percent'         => 45,
            'gtalents_percent'         => 5,
            'is_active'                => true,
            'language_id'              => 2,
            'created_at'               => \Carbon\Carbon::now(),
            'updated_at'               => \Carbon\Carbon::now(),
        ]);

    }
}
