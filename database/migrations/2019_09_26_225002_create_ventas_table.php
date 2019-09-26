<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("id_cliente")->unsigned();
            $table->integer("id_factura")->unsigned();
            $table->integer("id_vendedor")->unsigned();
            $table->integer("total");
            $table->date("fecha");
            $table->time("hora");
            $table->timestamps();

            //Relaciones
            $table->foreign("id_cliente")->references("id")->on("clientes")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->foreign("id_factura")->references("id")->on("facturas")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->foreign("id_vendedor")->references("id")->on("vendedores")
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
        Schema::dropIfExists('ventas');
    }
}
