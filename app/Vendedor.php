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
    public function supervisor(){
    	return $this->belongsTo(Supervisor::class,"id_supervisor");
    }



}
