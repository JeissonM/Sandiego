<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonanaturalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personanaturals', function (Blueprint $table) {
            $table->id();
            $table->string('direccion', 100)->nullable();
            $table->string('mail', 100)->nullable();
            $table->string('celular', 20)->nullable();
            $table->string('telefono', 50)->nullable();
            $table->string('numero_documento', 15);
            $table->string('lugar_expedicion', 50)->nullable();
            $table->date('fecha_expedicion')->nullable();
            $table->string('primer_nombre', 50);
            $table->string('segundo_nombre', 50)->nullable();
            $table->string('sexo', 1)->default('F');
            $table->date('fecha_nacimiento')->nullable();
            $table->string('libreta_militar', 15)->nullable();
            $table->string('rh', 4)->nullable();
            $table->string('primer_apellido', 50);
            $table->string('segundo_apellido', 50)->nullable();
            $table->string('distrito_militar', 10)->nullable();
            $table->string('clase_libreta', 100)->nullable();
            $table->bigInteger('tipodoc_id')->unsigned();
            $table->foreign('tipodoc_id')->references('id')->on('tipodocs')->onDelete('cascade');
            $table->bigInteger('estadocivil_id')->unsigned()->nullable();
            $table->foreign('estadocivil_id')->references('id')->on('estadocivils')->onDelete('cascade');
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
        Schema::dropIfExists('personanaturals');
    }
}
