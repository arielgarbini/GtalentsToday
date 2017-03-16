<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacancyLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancy_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('vacancy_id');
            $table->unsignedInteger('candidate_id')->nullable();
            $table->string('name');
            $table->string('description');
            $table->unsignedInteger('positions_number');
            $table->unsignedInteger('scheme_work_id')->nullable();
            $table->string('responsabilities');
            $table->string('experience', 255);
            $table->string('file')->nullable();
            $table->string('key_points');
            $table->double('minimum_salary');
            $table->double('maximum_salary');
            $table->string('career_plan');
            $table->unsignedInteger('contract_type_id')->nullable();
            $table->string('sharing')->nullable();
            $table->unsignedInteger('address_type_id')->nullable();
            $table->string('address', 255);
            $table->unsignedInteger('state_id');
            $table->string('zip_code');
            $table->string('city', 255);
            $table->integer('is_active');
            $table->unsignedInteger('vacancy_status_id')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->engine = 'InnoDB';

            $table->foreign('vacancy_id')
                  ->references('id')->on('vacancies')
                  ->onDelete('cascade');

            $table->foreign('scheme_work_id')
                  ->references('id')->on('scheme_works')
                  ->onDelete('cascade');

            $table->foreign('contract_type_id')
                  ->references('id')->on('contract_types')
                  ->onDelete('cascade');

            $table->foreign('address_type_id')
                  ->references('id')->on('address_types')
                  ->onDelete('cascade');

            $table->foreign('vacancy_status_id')
                  ->references('id')->on('vacancy_status')
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
        Schema::drop('vacancy_logs');
    }
}
