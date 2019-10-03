<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
	protected $table="vendedores";

    protected $fillable=[
    	"name","surname","email","phone","id_supervisor"
    ];
    protected $hidden=[

    ];

}
