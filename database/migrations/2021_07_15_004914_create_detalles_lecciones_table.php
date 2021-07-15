<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesLeccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_lecciones', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('descripcion');

            $table->unsignedBigInteger('leccion_id');
            $table->foreign('leccion_id', 'leccion_id')->references('id')->on('lecciones');
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
        Schema::dropIfExists('detalles_lecciones');
    }
}
