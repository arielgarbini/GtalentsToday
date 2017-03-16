<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('username')->nullable()->unique();
            $table->string('password');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('secundary_phone')->nullable();
            $table->string('avatar')->nullable();
            $table->string('prefix')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedInteger('address_id')->nullable();
            $table->date('birthday')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->string('confirmation_token', 60)->nullable();
            $table->string('code',45);
            $table->string('status', 20);
            $table->tinyInteger('is_active');
            $table->timestamp('time_connect')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('years_recruitment_id')->nullable();
            $table->unsignedInteger('education_level_id')->nullable();
            $table->string('assisted_schools')->nullable();
            $table->string('memberships')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('address_id')
                  ->references('id')->on('address')
                  ->onDelete('cascade');

            $table->foreign('category_id')
                  ->references('id')->on('categories')
                  ->onDelete('cascade');

            $table->foreign('years_recruitment_id')
                  ->references('id')->on('experience_years')
                  ->onDelete('cascade');

            $table->foreign('education_level_id')
                  ->references('id')->on('education_levels')
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
        Schema::drop('users');
    }
}
