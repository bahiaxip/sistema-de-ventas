<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//use Illuminate\Support\Facades\Auth;
use Auth;
use Illuminate\Validation\Rule;

class VentaStoreRequest extends FormRequest
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
            "total"=>["required",Rule::in([0])]
        ];
        return $rules;
    }
}