<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SupervisorUpdateRequest extends FormRequest
{    
    public function authorize()
    { 
        return Auth::check();
    }
    
    public function rules()
    {
        return [
            "name"=>"required|string",
            "surname"=>"required|string",
            "email" => "required|email|unique:supervisores,email,".$this->supervisor->id,
            "phone" => "required|digits_between:8,13"
        ];
    }
}