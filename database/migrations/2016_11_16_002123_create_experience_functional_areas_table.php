<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperienceFunctionalAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience_functional_areas', function (Blueprint $table) {
            $table->unsignedInteger('experience_id');
            $table->unsignedInteger('functional_area_id');

            $table->engine = 'InnoDB';

            $table->foreign('experience_id')
                  ->references('id')->on('experiences')
                  ->onDelete('cascade');

            $table->foreign('functional_area_id')
                  ->references('id')->on('functional_areas')
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
        Schema::drop('experience_functional_areas');
    }
}
