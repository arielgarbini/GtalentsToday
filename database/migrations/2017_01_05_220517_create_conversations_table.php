<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sender_user_id');
            $table->unsignedInteger('destinatary_user_id');

            $table->engine = 'InnoDB';
            $table->foreign('sender_user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('destinatary_user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');      

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('conversations');
    }
}
