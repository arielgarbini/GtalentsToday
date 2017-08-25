<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('address_type_id')->nullable();
            $table->string('address', 255);
            $table->string('complement', 255)->nullable();
            $table->unsignedInteger('state_id');
            $table->string('zip_code')->nullable();
            $table->string('city', 255);
            $table->integer('is_active');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->engine = 'InnoDB';

            $table->foreign('address_type_id')
                  ->references('id')->on('address_types')
                  ->onDelete('cascade');

            $table->foreign('state_id')
                  ->references('id')->on('states')
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
        Schema::drop('address');
    }
}
