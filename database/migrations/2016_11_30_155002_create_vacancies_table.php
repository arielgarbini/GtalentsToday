<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('poster_user_id');

           /* $table->string('description');
            $table->unsignedInteger('scheme_work_id');
            $table->string('target_companies');
            
            $table->string('experience', 255);
            $table->string('file');
            $table->string('key_points');
            $table->double('minimum_salary');
            $table->double('maximum_salary');
            $table->string('career_plan');
          
            $table->string('sharing');
            $table->unsignedInteger('address_id');
            $table->unsignedInteger('vacancy_status_id');  */ 
            

            $table->string('name');            
            $table->unsignedInteger('positions_number');
            $table->string('location');
            $table->string('target_companies');
            $table->string('off_limits_companies');
            $table->string('responsabilities');
            $table->string('required_experience');
            $table->string('key_position_questions');
            $table->string('file_job_description');
            $table->string('file_employer');
            $table->string('industry');
            $table->string('search_type');
            $table->unsignedInteger('contract_type_id');
            $table->string('years_experience');
            $table->unsignedInteger('especialization_id');
            $table->string('range_salary');
            $table->string('replacement_period');
            $table->string('general_conditions');
            $table->string('warranty_employer');
            $table->boolean('group1');
            $table->boolean('group2');
            $table->string('fee');
            $table->string('terms');
            $table->unsignedInteger('vacancy_status_id');

              
          
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->engine = 'InnoDB';

            $table->foreign('poster_user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

        /*    $table->foreign('scheme_work_id')
                  ->references('id')->on('scheme_works')
                  ->onDelete('cascade');*/

            $table->foreign('contract_type_id')
                  ->references('id')->on('contract_types')
                  ->onDelete('cascade');

          /*  $table->foreign('address_id')
                  ->references('id')->on('address')
                  ->onDelete('cascade');*/

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
        Schema::drop('vacancies');
    }
}
