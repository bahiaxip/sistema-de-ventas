<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable=[
    	"id_cliente","destinatario_id","id_vendedor","total","date","time"
    ];


    public function cliente(){

    	return $this->belongsTo(Cliente::class,"id_cliente");
    }

    public function destinatario()
    {
    	return $this->belongsTo(Destinatario::class);
    }

    public function vendedor()
    {
    	return $this->belongsTo(Vendedor::class,"id_vendedor");
    }
}
