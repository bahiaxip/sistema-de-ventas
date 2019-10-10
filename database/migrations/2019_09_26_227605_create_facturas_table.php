<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->increments('id');
            $table->date("fecha_emision");            
            $table->integer("neto");
            $table->integer("iva");
            $table->integer("total");
            $table->string("estado");
            $table->string("orden_compra");
            $table->string("guia_despacho");
            $table->integer("venta_id")->unsigned();
            $table->timestamps();

            //Relaciones            
            $table->foreign("venta_id")->references("id")->on("ventas")
                ->onDelete("cascade")
                ->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturas');
    }
}
