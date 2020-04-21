<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePadreestudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('padreestudiantes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('padrefamilia_id')->unsigned(); //padre
            $table->foreign('padrefamilia_id')->references('id')->on('padrefamilias')->onDelete('cascade');
            $table->bigInteger('estudiante_id')->unsigned(); //estudiante
            $table->foreign('estudiante_id')->references('id')->on('estudiantes')->onDelete('cascade');
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
        Schema::dropIfExists('padreestudiantes');
    }
}
