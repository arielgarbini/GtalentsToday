<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperienceSourcingNetworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience_sourcing_networks', function (Blueprint $table) {
            $table->unsignedInteger('experience_id');
            $table->unsignedInteger('sourcing_network_id');

            $table->engine = 'InnoDB';

            $table->foreign('experience_id')
                  ->references('id')->on('experiences')
                  ->onDelete('cascade');

            $table->foreign('sourcing_network_id')
                  ->references('id')->on('sourcing_networks')
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
        Schema::drop('experience_sourcing_networks');
    }
}
