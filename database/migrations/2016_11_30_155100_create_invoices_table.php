<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('vacancy_id');
            $table->string('number');
            $table->string('name');
            $table->double('amount');
            $table->double('tax');
            $table->unsignedInteger('supplier_user_id');
            $table->unsignedInteger('poster_user_id');
            $table->string('status');
            $table->timestamp('payment_due');
            $table->nullableTimestamps();

            $table->engine = 'InnoDB';

            $table->foreign('supplier_user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('poster_user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('vacancy_id')
                  ->references('id')->on('vacancies')
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
        Schema::drop('invoices');
    }
}
