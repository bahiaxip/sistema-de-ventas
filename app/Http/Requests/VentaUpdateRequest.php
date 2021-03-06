<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class VentaUpdateRequest extends FormRequest
{    
    public function authorize()
    {
        return Auth::check();
        
    }
 
    public function rules()
    {
        $rules = [
            "id_cliente"=>"required|exists:clientes,id",
            "destinatario_id"=>"required|exists:destinatarios,id",
            "id_vendedor"=>"required|exists:vendedores,id",
            "total"=>"required|numeric"            
        ];
        return $rules;
    }
}