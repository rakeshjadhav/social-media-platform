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

    public function getToken()
    {
        $header = $this->headers->get('Authorization');

        if (strpos($header, 'Bearer ') === 0) {
            $token = substr($header, 7);

            // Convert the token into values and keys
            $tokenParts = explode('.', $token);
            $values = base64_decode($tokenParts[1]);
            $keys = base64_decode($tokenParts[0]);

            return  [
                'values' => json_decode($values, true),
                'keys' => json_decode($keys, true),
            ];

            return null;
        }
    }
}
