<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendedorUpdateRequest extends FormRequest
{    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name"=> "required|string",
            "surname"=> "required|string",
            "email"=> "required|email|unique:vendedores,email,".$this->vendedor->id,
            "phone"=> "required|digits_between:8,13",
            //"phone"=> "required|digits:9",
            "id_supervisor"=>"required|exists:supervisores,id",

        ];
    }
}