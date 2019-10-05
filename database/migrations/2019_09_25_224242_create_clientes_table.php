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
            $table->string("nif")->unique();
            $table->string("name");
            $table->string("surname");
            $table->string("address");
            $table->string("province")->nullable();
            $table->string("country");
            $table->string("postal_code");
            $table->string("logo")->nullable();
            $table->string("email")->nullable();
            $table->string("phone");
            $table->string("fax")->nullable();
            $table->string("cellphone")->nullable();
            $table->string("web")->nullable();
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
