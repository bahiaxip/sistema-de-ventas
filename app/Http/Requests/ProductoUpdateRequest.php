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
            "price"=>"required|regex:/^\d{1,5}(?:\.\d\d\d)*.\d\d$/",
            "description"=>"required|string",
            "stock"=>"required|integer",
            "category_id"=>"required|string"
        ];
    }
    public function messages(){
        return [
            "price.required"=>"Es necesario agregar un precio",
            "price.regex"=>"El precio debe incluir 2 decimales"
            
        ];
    }
}