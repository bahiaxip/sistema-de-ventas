<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_factura extends Model
{
	protected $table="detalle_factura";
    protected $fillable=[
    	"id_producto","cantidad","id_factura"
    ];

    public function factura(){
    	return $this->belongsTo(Factura::class,"id_factura");
    }

    public function productos(){
    	return $this->belongsTo(Producto::class,"id_producto");
    }
}
