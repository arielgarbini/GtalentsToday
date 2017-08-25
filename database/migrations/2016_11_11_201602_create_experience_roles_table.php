<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperienceRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('value_id');
            $table->string('name');
            $table->unsignedInteger('language_id');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('language_id')
                  ->references('id')->on('languages')
                  ->onDelete('cascade');

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('experience_roles');
    }
}
