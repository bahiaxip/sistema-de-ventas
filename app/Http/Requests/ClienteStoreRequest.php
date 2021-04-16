<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ClienteStoreRequest extends FormRequest
{    
    public function authorize()
    {
        return Auth::check();
    }
 
    public function rules()
    {
        $rules= [
            "nif"=>"required|unique:clientes,nif",
            "name"=>"required|string",
            "surname"=>"required|string",
            "country"=>"required|string",
            "province"=>"nullable|string",
            "city"=>"required|string",
            "address"=>"required|string",
            "postal_code"=>"required|string",
            "logo"=>"nullable|image|mimes:jpg,jpeg,png|max:2048",
            "email"=>"nullable|email",
            "phone"=>"required|numeric",
            "fax"=>"nullable|numeric",
            "cellphone"=>"nullable|numeric",
            "web"=>"nullable|string"
        ];
        return $rules;
    }
}