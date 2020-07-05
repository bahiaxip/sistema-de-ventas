<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destinatario extends Model
{
    protected $fillable=[
    	"name","surname","country","province","city","address","postal_code","email","phone","fax","cellphone"
    ];
}