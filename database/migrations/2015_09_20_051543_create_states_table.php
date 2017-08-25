<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Creates the users table
        Schema::create('states', function(Blueprint $table)
        {           
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->unsignedInteger('country_id');
            $table->timestamps();
        });

        Schema::table('states', function(Blueprint $table) {
            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::table('states', function(Blueprint $table) {
            $table->dropForeign('states_country_id_foreign');
        });
        Schema::drop('states');
    }
}
