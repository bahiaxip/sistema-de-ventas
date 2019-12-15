<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Illuminate\Validation\Rule;
class RoleStoreRequest extends FormRequest
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
        return [
            "name"=>"required|string",
            "slug"=>"required|string",
            "description"=>"required|string",
            "special"=>["nullable",Rule::in(["all-access","no-access"])],
            "permissions"=>"nullable",
            "permissions.*"=>"integer|exists:permissions,id"

        ];
    }
}
