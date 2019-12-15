<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class DestinatarioStoreRequest extends FormRequest
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
