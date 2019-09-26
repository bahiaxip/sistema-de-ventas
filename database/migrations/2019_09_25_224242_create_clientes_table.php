<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nif");
            $table->string("nombre");
            $table->string("apellidos");
            $table->string("direccion");
            $table->string("provincia");
            $table->string("pais");
            $table->integer("c_postal");
            $table->string("logo");
            $table->string("correo");
            $table->string("telefono");
            $table->string("fax");
            $table->string("movil");
            $table->string("web");
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
        Schema::dropIfExists('clientes');
    }
}
