<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPkTipoLeccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detalles_lecciones', function(Blueprint $table){
            $table->unsignedBigInteger('pk_tipo');
            $table->foreign('pk_tipo', 'pk_tipo')->references('id')->on('tipos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detalles_lecciones', function(Blueprint $table){
            $table->dropForeign(['pk_tipo']);
            $table->dropColumn('pk_tipo');
        });
    }
}
