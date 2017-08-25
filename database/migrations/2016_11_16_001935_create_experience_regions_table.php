<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperienceRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience_regions', function (Blueprint $table) {
            $table->unsignedInteger('experience_id');
            $table->unsignedInteger('region_id');

            $table->engine = 'InnoDB';

            $table->foreign('experience_id')
                  ->references('id')->on('experiences')
                  ->onDelete('cascade');

            $table->foreign('region_id')
                  ->references('id')->on('regions')
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
        Schema::drop('experience_regions');
    }
}
