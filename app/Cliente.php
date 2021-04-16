<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable=[
    	"nif","name","surname","address","province","country","city","postal_code","logo","email","phone","fax","cellphone","web"
    ];
}
