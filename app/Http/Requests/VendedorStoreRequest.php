<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendedorStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name"=> "required|string",
            "surname"=> "required|string",
            "email"=> "required|email|unique:vendedores,email",
            "phone"=> "required|digits_between:8,13",
            //"phone"=> "required|digits:9",
            "id_supervisor"=>"required|exists:supervisores,id"
        ];
    }
}
