<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteUpdateRequest extends FormRequest
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
        //quizás no se debería permitir cambiar el nif
        $rules= [
            "nif"=>"required|unique:clientes,nif,".$this->cliente->id,
            "name"=>"required|string",
            "surname"=>"required|string",
            "address"=>"required|string",
            "province"=>"nullable|string",
            "country"=>"required|string",
            "postal_code"=>"required|string",
            "logo"=>"nullable|image|mimes:jpg,jpeg,png|max:2048",
            "email"=>"nullable|email",
            "phone"=>"required|numeric",
            "fax"=>"nullable|numeric",
            "cellphone"=>"nullable|numeric",
            "web"=>"nullable|string"
        ];
        /*if($this->get("logo"))
            $rules=array_merge($rules,["logo"=>"mimes:jpg,jpeg,png|max:2048"]);*/

        return $rules;
    }
}
