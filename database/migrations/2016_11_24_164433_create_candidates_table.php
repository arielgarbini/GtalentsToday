<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('supplier_user_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('profile')->nullable();
            $table->string('file')->nullable();
            $table->string('email');
            $table->string('code')->nullable();
            $table->unsignedInteger('is_active')->nullable();
            $table->unsignedInteger('accept_terms_cond')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('supplier_user_id')
                  ->references('id')->on('users')
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
        Schema::drop('candidates');
    }
}
