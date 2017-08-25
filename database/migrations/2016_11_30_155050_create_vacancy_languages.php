<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacancyLanguages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancy_languages', function (Blueprint $table) {
            $table->unsignedInteger('vacancy_id');
            $table->unsignedInteger('language_id');

            $table->engine = 'InnoDB';

            $table->foreign('vacancy_id')
                  ->references('id')->on('vacancies')
                  ->onDelete('cascade');

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
        Schema::drop('vacancy_languages');
    }
}
