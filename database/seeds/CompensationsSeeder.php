<?php

use Illuminate\Database\Seeder;
use Vanguard\Compensation;

class CompensationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Compensation::create([
            'salary'                => "USD 10K - 15K",
            'created_at'                => \Carbon\Carbon::now(),
            'updated_at'                => \Carbon\Carbon::now(),
        ]);
        Compensation::create([
            'salary'                => "USD 15K - 20K",
            'created_at'                => \Carbon\Carbon::now(),
            'updated_at'                => \Carbon\Carbon::now(),
        ]);
        Compensation::create([
            'salary'                => "USD 20K - 25K",
            'created_at'                => \Carbon\Carbon::now(),
            'updated_at'                => \Carbon\Carbon::now(),
        ]);
        Compensation::create([
            'salary'                => "USD 25K - 30K",
            'created_at'                => \Carbon\Carbon::now(),
            'updated_at'                => \Carbon\Carbon::now(),
        ]);
        Compensation::create([
            'salary'                => "USD 30K - 40K",
            'created_at'                => \Carbon\Carbon::now(),
            'updated_at'                => \Carbon\Carbon::now(),
        ]);
        Compensation::create([
            'salary'                => "USD 40K - 50K",
            'created_at'                => \Carbon\Carbon::now(),
            'updated_at'                => \Carbon\Carbon::now(),
        ]);
        Compensation::create([
            'salary'                => "USD 50K - 60K",
            'created_at'                => \Carbon\Carbon::now(),
            'updated_at'                => \Carbon\Carbon::now(),
        ]);
        Compensation::create([
            'salary'                => "USD 70K - 80K",
            'created_at'                => \Carbon\Carbon::now(),
            'updated_at'                => \Carbon\Carbon::now(),
        ]);
        Compensation::create([
            'salary'                => "USD 90K - 100K",
            'created_at'                => \Carbon\Carbon::now(),
            'updated_at'                => \Carbon\Carbon::now(),
        ]);
        Compensation::create([
            'salary'                => "USD 100K - 125K",
            'created_at'                => \Carbon\Carbon::now(),
            'updated_at'                => \Carbon\Carbon::now(),
        ]);
        Compensation::create([
            'salary'                => "USD 125K - 150K",
            'created_at'                => \Carbon\Carbon::now(),
            'updated_at'                => \Carbon\Carbon::now(),
        ]);
        Compensation::create([
            'salary'                => "USD 150K - 175K",
            'created_at'                => \Carbon\Carbon::now(),
            'updated_at'                => \Carbon\Carbon::now(),
        ]);
        Compensation::create([
            'salary'                => "USD 175K - 200K",
            'created_at'                => \Carbon\Carbon::now(),
            'updated_at'                => \Carbon\Carbon::now(),
        ]);
        Compensation::create([
            'salary'                => "USD 200K - 225K",
            'created_at'                => \Carbon\Carbon::now(),
            'updated_at'                => \Carbon\Carbon::now(),
        ]);
        Compensation::create([
            'salary'                => "USD 225K - 250K",
            'created_at'                => \Carbon\Carbon::now(),
            'updated_at'                => \Carbon\Carbon::now(),
        ]);
        Compensation::create([
            'salary'                => "USD 250K - 275K",
            'created_at'                => \Carbon\Carbon::now(),
            'updated_at'                => \Carbon\Carbon::now(),
        ]);
        Compensation::create([
            'salary'                => "USD 275K - 300K",
            'created_at'                => \Carbon\Carbon::now(),
            'updated_at'                => \Carbon\Carbon::now(),
        ]);
        Compensation::create([
            'salary'                => "USD 300K - 350K",
            'created_at'                => \Carbon\Carbon::now(),
            'updated_at'                => \Carbon\Carbon::now(),
        ]);
        Compensation::create([
            'salary'                => "USD 350K - 400K",
            'created_at'                => \Carbon\Carbon::now(),
            'updated_at'                => \Carbon\Carbon::now(),
        ]);
        Compensation::create([
            'salary'                => "USD 400K - 500K",
            'created_at'                => \Carbon\Carbon::now(),
            'updated_at'                => \Carbon\Carbon::now(),
        ]);
    }
}
