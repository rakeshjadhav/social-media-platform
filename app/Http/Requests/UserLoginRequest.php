<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MergeRequestParamForValidation;

class UserLoginRequest extends FormRequest
{
    use MergeRequestParamForValidation;

    public function rules(): array
    {
        return [
            'username' => 'required|string|email',
            'password' => 'required|string',
        ];
    }
}