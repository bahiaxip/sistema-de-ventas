<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ClienteStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules= [
            "nif"=>"required|unique:clientes,nif",
            "name"=>"required",
            "surname"=>"required",
            "address"=>"required",
            "province"=>"nullable",
            "country"=>"required",
            "postal_code"=>"required",
            "logo"=>"nullable|image|mimes:jpg,jpeg,png|max:2048",
            "email"=>"nullable|email",
            "phone"=>"required",
            "fax"=>"nullable",
            "cellphone"=>"nullable",
            "web"=>"nullable"
        ];
        /*if($this->get("logo"))
            $rules=array_merge($rules,["logo"=>"mimes:jpg,jpeg,png|max:2048"]);*/

        return $rules;
    }
}
