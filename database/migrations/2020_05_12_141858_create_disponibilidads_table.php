<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisponibilidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disponibilidads', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->integer('horainicio');
            $table->integer('horafin');
            $table->string('estado')->default('DISPONIBLE');
            $table->bigInteger('periodo_id')->unsigned();
            $table->foreign('periodo_id')->references('id')->on('periodos')->onDelete('cascade');
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
        Schema::dropIfExists('disponibilidads');
    }
}
