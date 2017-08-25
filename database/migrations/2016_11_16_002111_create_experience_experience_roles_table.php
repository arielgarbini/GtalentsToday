<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperienceExperienceRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience_experience_roles', function (Blueprint $table) {
            $table->unsignedInteger('experience_id');
            $table->unsignedInteger('experience_role_id');

            $table->engine = 'InnoDB';

            $table->foreign('experience_id')
                  ->references('id')->on('experiences')
                  ->onDelete('cascade');

            $table->foreign('experience_role_id')
                  ->references('id')->on('experience_roles')
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
        Schema::drop('experience_experience_roles');
    }
}
