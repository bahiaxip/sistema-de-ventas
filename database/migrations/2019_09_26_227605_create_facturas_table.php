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
            $table->integer("net");
            $table->integer("vat");
            $table->integer("total");
            $table->enum("state",["DUE","PAYED"]);
            $table->string("order_buy")->nullable();
            $table->string("office_guide")->nullable();
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
