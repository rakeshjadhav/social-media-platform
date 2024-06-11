<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MergeRequestParamForValidation;

class CreatePostFormRequest extends BaseUserFormRequest
{
    use MergeRequestParamForValidation;

    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ];
    
    }

    
}
