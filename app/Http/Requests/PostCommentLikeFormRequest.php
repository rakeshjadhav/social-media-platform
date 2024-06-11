<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\MergeRequestParamForValidation;

class PostCommentLikeFormRequest extends BaseUserFormRequest
{
    use MergeRequestParamForValidation;

    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'comment_id' => 'required|uuid|exists:comments,id',
        ];
    
    }

    
}
