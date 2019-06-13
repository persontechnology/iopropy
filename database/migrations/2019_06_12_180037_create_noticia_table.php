<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('titulo');
            $table->text('detalle');
            $table->string('imagen');
            $table->boolean('estado');
            $table->unsignedBigInteger('propiedad_id')->nullable();
            $table->foreign('propiedad_id')->references('id')->on('propiedad')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('noticia');
    }
}
