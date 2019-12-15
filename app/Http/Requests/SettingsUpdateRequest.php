<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SettingsUpdateRequest extends FormRequest
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
            "design_index"=>["required",Rule::in(["ICONS","BUTTONS"])],
            "vat"=>"required|integer|min:1"
        ];
    }

    public function messages(){
        return [
            "design_index.required"=>"Es necesario un tipo de botón",
            "design_index.in"=>"Es necesario un tipo de botón válido",
            "vat.required"=>"El campo IVA es obligatorio",
            "vat.min"=>"El campo IVA no puede ser menos de 1",
        ];
    }
}
