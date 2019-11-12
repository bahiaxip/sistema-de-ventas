<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//use Illuminate\Support\Facades\Auth;
use Auth;
use Illuminate\Validation\Rule;
class VentaStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
        //return true;
        return Auth::check(); 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
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
