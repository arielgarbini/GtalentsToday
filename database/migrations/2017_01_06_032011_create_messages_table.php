<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sender_user_id');
            $table->unsignedInteger('destinatary_user_id');
            $table->unsignedInteger('conversation_id');
            $table->integer('status_sender_user');
            $table->integer('status_destinatary_user');
            
            $table->string('subject')->nullable();
            $table->string('message')->nullable();
            $table->integer('status');
            $table->nullableTimestamps();
            $table->timestamp('deleted_by_sender')->nullable();
            $table->timestamp('deleted_by_destinatary')->nullable();
            $table->softDeletes();

            $table->foreign('sender_user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('destinatary_user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade'); 

            $table->foreign('conversation_id')
                  ->references('id')->on('conversations')
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
        Schema::drop('messages');
    }
}
