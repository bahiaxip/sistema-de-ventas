<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDestinatariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinatarios', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string("nombre");
            $table->string("apellidos");
            $table->string("direccion");
            $table->string("ciudad");
            $table->string("pais");
            $table->integer("c_postal");
            $table->string("telefono");
            $table->string("correo");
            $table->string("fax");
            $table->string("movil");
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
        Schema::dropIfExists('destinatarios');
    }
}
