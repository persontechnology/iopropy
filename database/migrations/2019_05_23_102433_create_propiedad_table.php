<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropiedadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propiedad', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('codigo')->unique();
            $table->string('medidaTotal');
            $table->string('linderoNorteCon')->nullable();
            $table->string('linderoSurCon')->nullable();
            $table->string('linderoEsteCon')->nullable();
            $table->string('linderoOesteCon')->nullable();

            $table->boolean('camino')->default(false);
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();

            $table->decimal('precioEstimado',19,2)->default(0);
            $table->boolean('serviciosBasicos')->default(false);

            $table->text('detalle')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('tieneCasa')->default(true);
            
            $table->bigInteger('usuarioCreado');
            $table->bigInteger('usuarioEditado')->nullable();

            $table->unsignedBigInteger('comunidad_id');
            $table->foreign('comunidad_id')->references('id')->on('comunidad');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('propiedad');
    }
}
