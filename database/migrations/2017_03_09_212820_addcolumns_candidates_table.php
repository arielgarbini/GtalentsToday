<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddcolumnsCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->string('telf');
            $table->unsignedInteger('actual_position_id');
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('compensation_id');

            $table->foreign('actual_position_id')
                     ->references('id')->on('actual_positions')
                     ->onDelete('cascade');        
            $table->foreign('company_id')
                 ->references('id')->on('companies')
                 ->onDelete('cascade');
            $table->foreign('country_id')
                     ->references('id')->on('countries')
                     ->onDelete('cascade');        
            $table->foreign('compensation_id')
                 ->references('id')->on('compensations')
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
        Schema::table('candidates', function (Blueprint $table) {
           /* $table->dropColumn('telf');
            $table->dropColumn('actual_position_id');
            $table->dropColumn('company_id');
            $table->dropColumn('country_id');
            $table->dropColumn('compensation_id');*/
        });
    }
}
