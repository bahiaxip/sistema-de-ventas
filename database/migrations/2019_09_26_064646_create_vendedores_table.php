<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendedores', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("surname");
            $table->string("phone",50);
            $table->string("email")->unique();
            $table->integer("id_supervisor")->unsigned();
            $table->timestamps();

            //Relaciones
            $table->foreign("id_supervisor")->references("id")->on("supervisores")
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
        Schema::dropIfExists('vendedores');
    }
}
