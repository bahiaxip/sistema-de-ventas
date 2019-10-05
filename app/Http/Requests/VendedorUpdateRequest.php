<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendedorUpdateRequest extends FormRequest
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
            "name"=> "required",
            "surname"=> "required",
            "email"=> "required|email|unique:vendedores,email,".$this->vendedor->id,
            "phone"=> "required|digits_between:8,13",
            //"phone"=> "required|digits:9",
            "id_supervisor"=>"required|integer",

        ];
    }
}
