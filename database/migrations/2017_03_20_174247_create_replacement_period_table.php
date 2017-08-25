<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplacementPeriodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replacement_periods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('value_id');
            $table->string('name');
            $table->unsignedInteger('language_id');
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';

            $table->foreign('language_id')
                ->references('id')->on('languages')
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
        Schema::drop('replacement_periods');
    }
}
