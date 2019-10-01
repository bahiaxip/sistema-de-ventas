<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
	protected $table="vendedores";

    protected $fillable=[
    	"nombre","apellidos","correo","telefono","id_supervisor"
    ];
    protected $hidden=[

    ];

}
