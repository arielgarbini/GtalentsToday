<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLegalInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legal_informations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('legal_first_name')->nullable();
            $table->string('legal_last_name')->nullable();
            $table->string('legal_company_name')->nullable();
            $table->string('company_type')->nullable();
            $table->string('principal_coin')->nullable();
            $table->unsignedInteger('address_id')->nullable();
            $table->unsignedInteger('accept_terms_cond')->nullable();

            $table->timestamps();

            $table->foreign('address_id')
                  ->references('id')->on('address')
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
        Schema::drop('legal_informations');
    }
}