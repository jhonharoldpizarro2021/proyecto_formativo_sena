<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable(false);
            $table->integer('rold_id')->nullable(false);
            $table->string('nombre', 45);
            $table->string('apellido', 45);
            $table->integer('tipo_doc')->nullable(false);
            $table->integer('documento');
            $table->integer('telefono');
            $table->date('fecha_nacimiento');
            $table->integer('sexo')->nullable(false);
            $table->integer('ciudad')->nullable(false);
            $table->integer('departamento')->nullable(false);
            $table->integer('estado_usuario')->nullable(false);
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
        Schema::dropIfExists('usuarios');
    }
}
