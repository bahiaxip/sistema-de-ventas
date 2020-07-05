<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class FacturaUpdateRequest extends FormRequest
{    
    public function authorize()
    {
        return Auth::check();
    }
 
    public function rules()
    {
        return [
            "net"=>"required|numeric",
            "vat"=>"required|integer",
            "total"=>"required|numeric",
            "state"=>"required|string",
            "order_buy"=>"nullable|numeric",
            "office_guide"=>"nullable|numeric"
        ];
    }
    public function messages(){
        return [
            "net.required"=>"Es necesario agregar algún producto",
            "net.integer"=>"Hubo un error",
            "vat.required"=>"Es necesario agregar algún producto",
            "vat.integer"=>"Hubo un error",
            "total.required"=>"Es necesario agregar algún producto",
            "total.integer"=>"Hubo un error",
            "state.required"=>"Hubo un error con el estado del pedido",
            "state.string"=>"Hubo un error con el estado del pedido",
            "order_buy.numeric"=>"El número de pedido debe ser numérico",
            "office_guide.numeric"=>"La guía de despacho debe ser numérico"
        ];
    }
}