<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacancyCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancy_candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('vacancy_id');
            $table->unsignedInteger('candidate_id');
            $table->string('status');
            $table->text('comment');
            $table->timestamps();
            $table->softDeletes();

            $table->engine = 'InnoDB';

            $table->foreign('vacancy_id')
                  ->references('id')->on('vacancies')
                  ->onDelete('cascade');

            $table->foreign('candidate_id')
                  ->references('id')->on('candidates')
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
        Schema::drop('vacancy_candidates');
    }
}
