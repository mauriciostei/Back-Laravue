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
        Schema::create('materias_personas', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('personas_id')->unsigned();
            $table->bigInteger('materias_id')->unsigned();
            $table->bigInteger('gestiones_id')->unsigned();

            $table->integer('nota')->default(null)->nullable();
            $table->string('rol', 30)->nullable();

            $table->foreign('personas_id')->references('id')->on('personas');
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
        Schema::dropIfExists('materias_personas');
    }
};
