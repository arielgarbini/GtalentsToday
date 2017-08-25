<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('recommended_user_id');
            $table->unsignedInteger('recommended_by_user_id');
            $table->string('testimony');
            $table->unsignedInteger('testimonial_status_id');
            $table->integer('is_active');
            $table->nullableTimestamps();

            $table->foreign('recommended_user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('recommended_by_user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('testimonial_status_id')
                  ->references('id')->on('testimonial_status')
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
        Schema::drop('testimonials');
    }
}
