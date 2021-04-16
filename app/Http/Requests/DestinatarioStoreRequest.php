<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class DestinatarioStoreRequest extends FormRequest
{    
    public function authorize()
    {
        return Auth::check();
    }
    
    public function rules()
    {
        $rules = [
            "name"=>"required|string",
            "surname"=>"required|string",
            "country"=>"required|string",
            "province"=>"nullable|string",
            "city"=>"required|string",
            "address"=>"required|string",
            "postal_code"=>"required|string",
            "email"=>"nullable|email",
            "phone"=>"required|numeric",
            "fax"=>"nullable|numeric",
            "cellphone"=>"nullable|numeric"
        ];
        return $rules;
    }
}