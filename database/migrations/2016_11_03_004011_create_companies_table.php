<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('comercial_name');
            $table->string('register_number');
            $table->string('description');
            $table->string('email')->nullable();
            $table->unsignedInteger('address_id');
            $table->string('website')->nullable();
            $table->unsignedInteger('quantity_employees_id');
            $table->tinyInteger('is_active');
            $table->timestamps();
            $table->softDeletes();

            $table->engine = 'InnoDB';

            $table->foreign('address_id')
                  ->references('id')->on('address')
                  ->onDelete('cascade');

            $table->foreign('quantity_employees_id')
                  ->references('id')->on('quantity_employees')
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
        Schema::drop('companies');
    }
}
