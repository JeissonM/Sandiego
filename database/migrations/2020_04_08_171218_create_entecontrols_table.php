<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntecontrolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entecontrols', function (Blueprint $table) {
            $table->id();
            $table->string('direccion', 100)->nullable();
            $table->string('mail', 100)->nullable();
            $table->string('celular', 20)->nullable();
            $table->string('telefono', 50)->nullable();
            $table->string('numero_documento', 15);
            $table->string('lugar_expedicion', 50)->nullable();
            $table->date('fecha_expedicion')->nullable();
            $table->string('numeroresolucion', 20)->nullable();
            $table->string('razonsocial', 100);
            $table->string('representantelegal', 80);
            $table->string('cargorepresentante', 50)->nullable();
            $table->string('fax', 20)->nullable();
            $table->bigInteger('tipopersonaj_id')->unsigned()->nullable();
            $table->foreign('tipopersonaj_id')->references('id')->on('tipopersonajs')->onDelete('cascade');
            $table->bigInteger('tipodoc_id')->unsigned();
            $table->foreign('tipodoc_id')->references('id')->on('tipodocs')->onDelete('cascade');
            $table->bigInteger('regimen_id')->unsigned()->nullable();
            $table->foreign('regimen_id')->references('id')->on('regimens')->onDelete('cascade');
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
        Schema::dropIfExists('entecontrols');
    }
}
