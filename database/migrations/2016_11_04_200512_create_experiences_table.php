<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creates the experiences table
        Schema::create('experiences', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('cases_number_id')->nullable();
            $table->unsignedInteger('experience_years_id')->nullable();
            $table->unsignedInteger('level_position_id')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->engine = 'InnoDB';

            $table->foreign('company_id')
                  ->references('id')->on('companies')
                  ->onDelete('cascade');

            $table->foreign('cases_number_id')
                  ->references('id')->on('cases_numbers')
                  ->onDelete('cascade');

            $table->foreign('experience_years_id')
                  ->references('id')->on('experience_years')
                  ->onDelete('cascade');

            $table->foreign('level_position_id')
                  ->references('id')->on('level_positions')
                  ->onDelete('cascade');
        });    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('experiences');
    }
}
