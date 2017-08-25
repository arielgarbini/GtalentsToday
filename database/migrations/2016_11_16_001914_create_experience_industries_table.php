<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperienceIndustriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience_industries', function (Blueprint $table) {
            $table->unsignedInteger('experience_id');
            $table->unsignedInteger('industry_id');

            $table->engine = 'InnoDB';

            $table->foreign('experience_id')
                  ->references('id')->on('experiences')
                  ->onDelete('cascade');

            $table->foreign('industry_id')
                  ->references('id')->on('industries')
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
        Schema::drop('experience_industries');
    }
}
