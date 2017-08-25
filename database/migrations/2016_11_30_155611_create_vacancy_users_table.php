<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacancyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancy_users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('vacancy_id');
            $table->unsignedInteger('supplier_user_id');
            $table->string('status');
            $table->integer('is_active');
            $table->string('comment', 255);
            $table->nullableTimestamps();

            $table->engine = 'InnoDB';

            $table->foreign('vacancy_id')
                  ->references('id')->on('vacancies')
                  ->onDelete('cascade');

            $table->foreign('supplier_user_id')
                  ->references('id')->on('users')
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
        Schema::drop('vacancy_users');
    }
}
