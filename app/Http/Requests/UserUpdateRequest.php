<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Auth;
class UserUpdateRequest extends FormRequest
{    
    public function authorize()
    {
        return Auth::check();
    }
 
    public function rules()
    {
        return [
            "name"=>"required|string",
            "roles"=>"nullable",
            "roles.*"=>"integer"
        ];
    }
}