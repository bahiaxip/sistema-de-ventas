<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $fillable=[
    	"net","vat","total","state","order_buy","office_guide","venta_id"
    ];

    public function venta(){
    	return $this->belongsTo(Venta::class);
    }
}