<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable=[
    	"name","product_model","price","description","stock","category_id","code"
    ];

    public function category(){
    	return $this->belongsTo(Category::class);
    }
}