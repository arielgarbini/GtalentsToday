<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description', 255);
            $table->unsignedInteger('language_id');
            $table->integer('value_id');
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
        Schema::drop('contract_types');
    }
}
