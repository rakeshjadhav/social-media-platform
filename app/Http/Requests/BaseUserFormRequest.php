<?php

namespace App\Http\Requests;

use App\Constants\UserStatusConstant;
use Illuminate\Validation\Rule;
use App\Traits\MergeRequestParamForValidation;

use Illuminate\Foundation\Http\FormRequest;

class BaseUserFormRequest extends FormRequest
{
    use MergeRequestParamForValidation;


    protected function defineEmailRule(): array
    {
        return ["required", "email:rfc,dns", "regex:/(.+)@(.+)\.(.+)/i"];
    }

    protected function defineStatusRule(): array
    {
        return ["required", Rule::in([UserStatusConstant::ACTIVE, UserStatusConstant::BLOCKED, UserStatusConstant::UNBLOCKED])];
    }

    protected function defineNameRule(): array
    {
        return ["required", "min:2", "max:50", "regex:/^[a-zA-Z0-9' ^’.-]+$/u"];
    }
}
