<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class ProductoStoreRequest extends FormRequest
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
            //el máximo permitido es 5 dígitos enteros y es obligatorio 2 decimales
            //si queremos cambiar los enteros modificar el 5 por otro {1,5}
            "price"=>"required|regex:/^\d{1,5}(?:\.\d\d\d)*.\d\d$/",
            "brand"=>"nullable|string",
            "description"=>"required|string",
            "stock"=>"required|integer",
            "category_id"=>"required|string",
            "code"=>"nullable|string"
        ];
    }
    public function messages(){
        return [
            "price.required"=>"Es necesario agregar un precio",            
            "price.regex"=>"El precio debe incluir 2 decimales"
            
        ];
    }
}