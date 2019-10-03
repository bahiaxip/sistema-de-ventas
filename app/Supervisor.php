<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
	protected $table = "supervisores";

	protected $fillable=[
		"name","surname","phone","email"
	];
	protected $hidden=[

    ];
}
