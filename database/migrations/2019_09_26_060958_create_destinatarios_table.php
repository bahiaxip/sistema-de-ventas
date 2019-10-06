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
            $table->string("name");
            $table->string("surname");
            $table->string("country");
            $table->string("province")->nullable();
            $table->string("city");
            $table->string("address");
            $table->string("postal_code");
            $table->string("email")->nullable();
            $table->string("phone");            
            $table->string("fax")->nullable();
            $table->string("cellphone")->nullable();
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
