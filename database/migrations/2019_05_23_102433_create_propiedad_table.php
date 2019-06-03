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

            $table->string('medidaTotal');

            $table->string('linderoNorteCon')->nullable();
            $table->string('linderoSurCon')->nullable();
            $table->string('linderoEsteCon')->nullable();
            $table->string('linderoOesteCon')->nullable();

            $table->boolean('camino')->default(false);
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();

            $table->decimal('precioEstimado',9,2)->default(0);
            $table->boolean('serviciosBasicos')->default(false);

            $table->text('detalle')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('tieneCasa')->default(true);
            
            $table->integer('estado')->default(1)->comment('1 creado propiedad,2 crear usuario antiguio y actual, 3 foto');
            $table->bigInteger('usuarioCreado');
            $table->bigInteger('usuarioEditado')->nullable();
            

            $table->unsignedBigInteger('propietarioActual_id')->nullable();
            $table->foreign('propietarioActual_id')->references('id')->on('users');
            
            $table->unsignedBigInteger('propietarioAntiguo_id')->nullable();
            $table->foreign('propietarioAntiguo_id')->references('id')->on('users');


            
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
