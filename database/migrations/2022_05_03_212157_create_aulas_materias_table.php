<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aulas_materias', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('aulas_id')->unsigned();
            $table->bigInteger('materias_id')->unsigned();
            $table->bigInteger('gestiones_id')->unsigned();

            $table->integer('dia');
            $table->integer('hora_ini');
            $table->integer('hora_fin');

            $table->foreign('aulas_id')->references('id')->on('aulas');
            $table->foreign('materias_id')->references('id')->on('materias');
            $table->foreign('gestiones_id')->references('id')->on('gestiones');

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
        Schema::dropIfExists('aulas_materias');
    }
};
