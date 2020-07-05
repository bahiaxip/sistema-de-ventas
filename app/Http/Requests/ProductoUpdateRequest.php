<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class ProductoUpdateRequest extends FormRequest
{    
    public function authorize()
    {
        return Auth::check();
    }
 
    public function rules()
    {
        return [
            "name"=>"required|string",
            "product_model"=>"required|string",
            "brand"=>"nullable|string",
            "price"=>"required|numeric",
            "description"=>"required|string",
            "stock"=>"required|integer",
            "category_id"=>"required|string"
        ];
    }
}