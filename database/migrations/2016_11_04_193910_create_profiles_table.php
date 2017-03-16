<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creates the profiles table
        Schema::create('profiles', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('company_id');
            $table->string('linkedin_url', 255)->nullable();
            $table->string('availability', 255);
            $table->integer('size');
            $table->float('points');
            $table->unsignedInteger('actual_position_id')->nullable();
            $table->unsignedInteger('profile_position_id')->nullable();
            $table->unsignedInteger('type_of_shared_search_id')->nullable();
            $table->unsignedInteger('type_of_involved_search_id')->nullable();
            $table->unsignedInteger('type_of_shared_opportunity_id')->nullable();
            $table->unsignedInteger('type_of_involved_opportunity_id')->nullable();
            $table->nullableTimestamps();

            $table->engine = 'InnoDB';

            $table->foreign('company_id')
                  ->references('id')->on('companies')
                  ->onDelete('cascade');

            $table->foreign('actual_position_id')
                  ->references('id')->on('actual_positions')
                  ->onDelete('cascade');

            $table->foreign('profile_position_id')
                  ->references('id')->on('profile_positions')
                  ->onDelete('cascade');

            $table->foreign('type_of_shared_search_id')
                  ->references('id')->on('type_of_shared_searchs')
                  ->onDelete('cascade');

            $table->foreign('type_of_involved_search_id')
                  ->references('id')->on('type_of_involved_searchs')
                  ->onDelete('cascade');

            $table->foreign('type_of_shared_opportunity_id')
                  ->references('id')->on('type_of_shared_opportunities')
                  ->onDelete('cascade');

            $table->foreign('type_of_involved_opportunity_id')
                  ->references('id')->on('type_of_involved_opportunities')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profiles');
    }
}
