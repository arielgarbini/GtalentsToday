<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferences', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('promotional_code')->nullable();
            $table->unsignedInteger('security_question1_id')->nullable();
            $table->string('answer1')->nullable();
            $table->unsignedInteger('security_question2_id')->nullable();
            $table->string('answer2')->nullable();
            $table->unsignedInteger('contact_id')->nullable();
            $table->unsignedInteger('organization_role_id')->nullable();
            $table->unsignedInteger('sourcing_network_id')->nullable();
            $table->integer('receive_messages')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->engine = 'InnoDB';

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('security_question1_id')
                  ->references('id')->on('security_questions')
                  ->onDelete('cascade');

            $table->foreign('security_question2_id')
                  ->references('id')->on('security_questions')
                  ->onDelete('cascade');

            $table->foreign('contact_id')
                  ->references('id')->on('contacts')
                  ->onDelete('cascade');

            $table->foreign('organization_role_id')
                  ->references('id')->on('organization_roles')
                  ->onDelete('cascade');

            $table->foreign('sourcing_network_id')
                  ->references('id')->on('sourcing_networks')
                  ->onDelete('cascade');
        });    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('preferences');
    }
}
